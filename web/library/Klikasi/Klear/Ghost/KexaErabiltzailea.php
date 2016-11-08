<?php

namespace Klikasi\Klear\Ghost;

class KexaErabiltzailea extends \KlearMatrix_Model_Field_Ghost_Abstract
{

    public function getData($model)
    {
        $erabiltzailea = $model->getErabiltzailea();

        $ret = $erabiltzailea->getCompletName();
        $ret .= '<span class="kexaEdukiaRel"><a class="_fieldOption option screen  ui-state-nojump" href="" '
            .'data-screen="erabiltzaileaList_screen" data-externalid="'.$erabiltzailea->getPosta().'" '
            .'data-externalfile="ErabiltzaileaList" data-externalnoiden="1" '
            .'data-externalsearchby="posta" '
            .'title="'.$erabiltzailea->getIzena().'-(r)en profila">'
            .'<span class="ui-silk inline ui-silk-user"></span> Erabiltzailea ikusi</a></span>';

        return $ret;
    }

}
