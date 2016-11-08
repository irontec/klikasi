<?php

namespace Klikasi\Klear\Ghost;

class KexaEdukia extends \KlearMatrix_Model_Field_Ghost_Abstract
{

    public function getData($model)
    {
        $edukia = $model->getEdukia();

        $ret = $edukia->getTitulua();
        $ret .= '<span class="kexaEdukiaRel"><a class="_fieldOption option screen  ui-state-nojump" href="" '
            .'data-screen="edukiaList_screen" data-externalid="'.$edukia->getTitulua().'" '
            .'data-externalfile="EdukiaList" data-externalnoiden="1" '
            .'data-externalsearchby="titulua" '
            .'title="'.$edukia->getTitulua().' ikusi">'
            .'<span class="ui-silk inline ui-silk-eye"></span> Edukia ikusi</a></span>';

        return $ret;
    }

}
