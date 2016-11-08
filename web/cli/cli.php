<?php
/**
 * Define path to application directory
 */
$applicationPath = dirname(__FILE__) . '/../application';
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath($applicationPath));

/**
 * Define application environment
 */
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

/**
 * Ensure library/ is on include_path
 */
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(APPLICATION_PATH . '/../library'),
            get_include_path()
        )
    )
);

/**
 * Zend_Application
 */
require_once 'Zend/Application.php';

/**
 * Create application, bootstrap, and run
 */
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap();

$options = array(
    'Edukia.Karma|k' => '* Recalcular karma en contenidos.',
    'JakinarazpenakG|j' => '* Comprueba y envia las Notificaciones Agrupables.',
    'Newsletter|n' => ' * Cron encargado del sistema de Newsletter.',
    'import Kategoriak|ik' => ' * Importa las Kategorias que envian de azkue.'
);

$currentTime = new \Zend_Date();
$now = $currentTime->toString('yyyy-MM-dd');

try {

    $opt = new Zend_Console_Getopt($options);
    if ($opt->getOption('k')) {

        $edukiaMapper = new \Klikasi\Mapper\Sql\Edukia();
        $dbAdapter = $edukiaMapper->getDbTable()->getAdapter();

        //Edukiak
        $queryVisual = 'select Edukia.id as edukiaId, Edukia.bisitakopurua as bisitak, AtseginDut.id as atsegin,   Iruzkina.id as iruzkina  from Edukia  left join AtseginDut on Edukia.id = AtseginDut.edukiaId  left join Iruzkina on Edukia.id = Iruzkina.edukiaId';
        $queryFinal = 'select Edukia.id as edukiaId, Edukia.bisitakopurua as bisitak, sum(AtseginDut.id is not null) as atsegin, sum(Iruzkina.id is not null) as iruzkina  from Edukia  left join AtseginDut on Edukia.id = AtseginDut.edukiaId  left join Iruzkina on Edukia.id = Iruzkina.edukiaId group by edukiaId';

        $records = $dbAdapter->fetchAll($queryFinal);
        foreach ($records as $record) {

            $karma = $record['bisitak'] + $record['atsegin'] + $record['iruzkina'];
            $updateQuery = 'update Edukia set karma = "'. $karma .'" where id = "'. $record['edukiaId'] .'"';

            $dbAdapter->query($updateQuery);
        }

        //Kategorias
        $queryVisual = "select Edukia.id, karma,titulua, EdukiaRelKategoria.kategoriaId, sum(karma) karmaKategoria from Edukia left join EdukiaRelKategoria on Edukia.id = EdukiaRelKategoria.edukiaId group by kategoriaId";
        $queryFinal = "select EdukiaRelKategoria.kategoriaId, sum(karma) karmaKategoria from Edukia left join EdukiaRelKategoria on Edukia.id = EdukiaRelKategoria.edukiaId group by kategoriaId limit 10;";

        $records = $dbAdapter->fetchAll($queryFinal);
        foreach ($records as $record) {

            $updateQuery = 'update Kategoria set karma = "'. $record['karmaKategoria'] .'" where id = "'. $record['kategoriaId'] .'"';
            $dbAdapter->query($updateQuery);
        }

        //Ikastegiak
        $queryVisual = "select Edukia.id, karma,titulua, EdukiaRelIkastegia.ikastegiaId, sum(karma) karmaIkastegia from Edukia left join EdukiaRelIkastegia on Edukia.id = EdukiaRelIkastegia.edukiaId group by ikastegiaId";
        $queryFinal = "select EdukiaRelIkastegia.ikastegiaId, sum(karma) karmaIkastegia from Edukia left join EdukiaRelIkastegia on Edukia.id = EdukiaRelIkastegia.edukiaId group by ikastegiaId";

        $records = $dbAdapter->fetchAll($queryFinal);
        foreach ($records as $record) {

            $updateQuery = 'update Ikastegia set karma = "'. $record['karmaIkastegia'] .'" where id = "'. $record['ikastegiaId'] .'"';
            $dbAdapter->query($updateQuery);
        }

        //Erabiltzailea
        $queryVisual = "select id, erabiltzaileaId, titulua, karma, sum(karma) from Edukia group by erabiltzaileaId";
        $queryFinal = "select erabiltzaileaId, sum(karma) as karma from Edukia group by erabiltzaileaId";

        $records = $dbAdapter->fetchAll($queryFinal);
        foreach ($records as $record) {

            $updateQuery = 'update Erabiltzailea set karma = "'. $record['karma'] .'" where id = "'. $record['erabiltzaileaId'] .'"';
            $dbAdapter->query($updateQuery);
        }

    } else if ($opt->getOption('j')) {

        $view = new \Zend_View();
        $zendDate = new \Zend_Date();
        $mustache = new \Mustache_Engine();

        $currentDate = $zendDate->toString(
            "y'eko' MMMM'ren' dd'a'",
            "eu"
        );

        $plantilla = 'templates/JakinarazpenakGroup.phtml';

        $body = $view->setScriptPath(
            APPLICATION_PATH .
            '/views/scripts'
        )->render($plantilla);

        $clientsMapper = new \Klikasi\Mapper\Sql\Erabiltzailea();
        $jakinarazpenakGroupMapper = new \Klikasi\Mapper\Sql\JakinarazpenakGroup();

        $where = array();
        $jakinarazpenakGroupList = $jakinarazpenakGroupMapper->fetchList(
            $where,
            'erabiltzaileaId ASC'
        );

        if (!empty($jakinarazpenakGroupList)) {

            echo "\n -- Hay (" . sizeof($jakinarazpenakGroupList) . ") Notificaciones -- \n\n";

            $groupSend = array();

            foreach ($jakinarazpenakGroupList as $jakinarazpenakGroup) {

                $clientId = $jakinarazpenakGroup->getErabiltzaileaId();
                $jakinarazpenak = $jakinarazpenakGroup->getJakinarazpenak();

                if (
                    $jakinarazpenak->getIkusita() == 0
                &&
                    $jakinarazpenak->getDeletedByErabiltzailea() == 0
                ) {
                    $groupSend[$clientId][] = $jakinarazpenakGroup->getJakinarazpenak();
                }//IF

                $jakinarazpenakGroup->delete();

            }//FOREACH

            foreach ($groupSend as $clientId => $jakinarazpenakList) {

                $erabiltzailea = $clientsMapper->find(
                    $clientId
                );

                echo "\n * " . $clientId . " tiene '" . sizeof($jakinarazpenakList) . "' notificaciones \n\n";

                if (sizeof($jakinarazpenakList) > 0) {

                    $data = array(
                        'Kolaborazio eskaera' => 0,
                        'Iruzkin berria' => 0,
                        'Gustoko berria' => 0,
                        'Atsegin dut' => 0,
                        'Irakasle eskaera' => 0
                    );

                    foreach ($jakinarazpenakList as $elemnt) {
                        if ($elemnt->getEgoera() == 'onartzeko') {
                            //1,5,9,11,17
                            switch ($elemnt->getMotaId()) {
                                case 1:
                                    $data['Kolaborazio eskaera'] = $data['Kolaborazio eskaera'] + 1;
                                    break;

                                case 5:
                                    $data['Iruzkin berria'] = $data['Iruzkin berria'] + 1;
                                    break;

                                case 9:
                                    $data['Gustoko berria'] = $data['Gustoko berria'] + 1;
                                    break;

                                case 11:
                                    $data['Atsegin dut'] = $data['Atsegin dut'] + 1;
                                    break;

                                case 17:
                                    $data['Irakasle eskaera'] = $data['Irakasle eskaera'] + 1;
                                    break;
                            }//SWITCH
                        }//IF
                    }//FOREACH

                    if ($erabiltzailea->getTypeAvatar() == 'default') {

                        $color = $erabiltzailea->getIrudiaDefault();
                        $userUrlAvatar = '/img/profila/' . $erabiltzailea->getProfila() . '-' . $color . '.png';

                    } elseif ($erabiltzailea->getTypeAvatar() == 'irudia') {

                        $img = $erabiltzailea->getIrudia();

                        if ($img) {
                            $userUrlAvatar = 'multimedia/erabiltzaile-irudia/irudia/' . $img->getIden();
                        } else {
                            $userUrlAvatar = 'http://placehold.it/42x42';
                        }

                    }//userUrlAvatar

                    $templateHtml = $mustache->render(
                        $body,
                        array(
                            'klikasiUrl' => $application->getOption('baseUrlKlikasi'),
                            'CompletName' => $erabiltzailea->getCompletName(),
                            'currentDate' => $currentDate,
                            'kolaborazioEskaera' => $data['Kolaborazio eskaera'],
                            'iruzkinBerria' => $data['Iruzkin berria'],
                            'gustokoBerria' => $data['Gustoko berria'],
                            'atseginDut' => $data['Atsegin dut'],
                            'irakasleEskaera' => $data['Irakasle eskaera'],
                            'userUrlProfile' => 'erabiltzaileak/ikusi/erabiltzailea/' . $erabiltzailea->getUrl(),
                            'userUrlAvatar' => $userUrlAvatar
                        )
                    );

                    $mail = new Zend_Mail('utf-8');
                    $mail->addTo(
                        $erabiltzailea->getPosta(),
                        $erabiltzailea->getCompletName()
                    );
                    $mail->setSubject('[Klikasi] Gaurko jakinarazpenak');
                    $mail->setBodyHtml($templateHtml);
                    $mail->setFrom('no-reply@klikasi.org', 'Klikasi');
                    $mail->send();

                }//IF
            }//Foreach

        } else {
            echo "\n -- No hay notificaciones -- " . $now . "\n\n";
        }

    // import-countries
    } else if ($opt->getOption('n')) {

        $now = new \Zend_Date();
        $now->setTimezone("Europe/Madrid");
        $nowString = $now->toString('yyyy-MM-dd HH:mm:ss');

        $where = array(
            'active = ?' => 1,
            'send = ?' => 0,
            'dateToSend < ?' => $nowString
        );
        $newsletters = new \Klikasi\Mapper\Sql\Newsletter();
        $newslettersList = $newsletters->fetchList($where);

        if (!empty($newslettersList)) {
            foreach ($newslettersList as $newsletter) {
                $newsletter->sendNewsletter();
            }
        }

    //Newsletter
    } else if ($opt->getOption('ik')) {

        $kategoriaGlobala = array();

        $kategoriaGlobala[] = array(
            'name' => 'Zientzia, matematikak eta teknologia',
            'sons' => array(
                'Biologia',
                'Fisika',
                'Geologia',
                'Kimika',
                'Lur eta ingurumen zientziak',
                'Giza anatomia eta fisiologia',
                'Elektrizitate eta elektronika',
                'Energia eta eraldatzea',
                'Egiturak eta mekanismoak',
                'Erabilpen teknikorako materialak',
                'Adierazpen eta komunikazio grafikorako teknikak',
                'Informazioaren teknologiak',
                'Informatika',
                'Laborategi teknikak',
                'Industri teknologia',
                'Algebra',
                'Analisia',
                'Aritmetika',
                'Estatistika',
                'Funtzioak',
                'Geometria',
                'Zenbaki eta neurriak'
            )
        );

        $kategoriaGlobala[] = array(
            'name' => 'Gizarte Zientziak, Geografia eta Historia',
            'sons' => array(
                'Ekonomia',
                'Geografia',
                'Historia',
                'Artearen historia',
                'Historia garaikidea'
            )
        );

        $kategoriaGlobala[] = array(
            'name' => 'Gorputz Hezkuntza',
            'sons' => array(
                'Jarduerak naturan',
                'Egoera fisikoa eta osasuna',
                'Kirolak',
                'Jokoak',
                'Erritmoa eta gorputz-adierazpena'
            )
        );

        $kategoriaGlobala[] = array(
            'name' => 'Arteak: Plastika, Ikus-Hezkuntza, Musika',
            'sons' => array(
                'Arkitektura',
                'Irudi teknikoa',
                'Diseinua, hezkuntza plastikoa',
                'Eskultura',
                'Argazkilaritza',
                'Ikus entzunezko hezkuntza',
                'Margoa',
                'Arte teknika eta materialak',
                'Musika taldeak',
                'Musika espazioak',
                'Musika tresnak',
                'Musika lengoaia',
                'Musika kultura eta gizartean',
                'Musika teknologia',
                'Artearen historia',
                'Artistak'
            )
        );

        foreach ($kategoriaGlobala as $kategoria) {

            echo "* " . $kategoria['name'] . " ---- \n";

//             $newKategoriaGlobala = new \Klikasi\Model\KategoriaGlobala();
//             $newKategoriaGlobala->setIzena($kategoria['name']);
//             $newKategoriaGlobala->save();
//             $newKategoriaGlobalaId = $newKategoriaGlobala->getId();

            foreach ($kategoria['sons'] as $sonKategoria) {

                echo " --- " . $sonKategoria . " \n";

//                 $newKategoria = new \Klikasi\Model\Kategoria();
//                 $newKategoria->setIzena($sonKategoria);
//                 $newKategoria->save();

//                 $newRelKategoria = new \Klikasi\Model\KategoriakRelKategoriaGlobalak();
//                 $newRelKategoria->setKategoriaId($newKategoria->getId());
//                 $newRelKategoria->setKategoriaGlobalaId($newKategoriaGlobalaId);
//                 $newRelKategoria->save();
            }
        }

        echo "\n\n DONE \n\n";
        //die();
    }

} catch (Zend_Console_Getopt_Exception $e) {

    echo $e->getUsageMessage();
    exit;

}