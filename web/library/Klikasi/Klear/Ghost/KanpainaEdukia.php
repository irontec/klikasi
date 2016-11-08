<?php

namespace Klikasi\Klear\Ghost;

class KanpainaEdukia extends \KlearMatrix_Model_Field_Ghost_Abstract
{

    public function getData(\Klikasi\Model\EdukiaRelKanpaina $model)
    {
        $edukia = $model->getEdukia();
        $kanpaina = $model->getKanpaina();
        
        $ret = '<span class="kanpainakoEdukiaRel"><a class="_fieldOption option screen  ui-state-nojump" href="" '
            .'data-screen="edukiaList_screen" data-externalid="'.$edukia->getTitulua().'" '
            .'data-externalfile="EdukiaList" data-externalnoiden="1" '
            .'data-externalsearchby="titulua" '
            .'title="'.$kanpaina->getIzena().' kanpainako edukia">'
            .'<span class="ui-silk inline ui-silk-eye"></span> Edukia ikusi</a></span>';

        return $ret;
    }

}

//EOF
