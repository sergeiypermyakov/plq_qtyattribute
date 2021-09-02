<?php
// no direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class plgJshoppingproductsPlq_qtyattribute extends JPlugin
{
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);
    }

    public function onBeforeDisplayProductView(&$view)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select('count', 'attr_18')
            ->from($db->quoteName('#__jshopping_products_attr'))
            ->where($db->quoteName('product_id') . " = " . $view->product->product_id)
            ->order($db->quoteName('attr_18') . ' ASC');

        $db->setQuery($query);
        $column = $db->loadColumn();
        $result1 = $db->loadResult();

        $column = array_slice($column, 1);
        $endsh = 'ах';
        $mog = '';
        $minsk = '';
        $orsha = '';
        foreach ($column as $key => $item) {
            if ($item == 0) {
                unset($column [$key]);
            }


            if (count($column) == 1) {
                $endsh = 'е';
            }
        }
            if ($column['1'] > 0) {
                if((int)$column[1]<=1){
                    $img = '<img src=/images/icon/ostatki_malo.svg class="ostatki_malo">';
                    $txttooltip = "Остался последний";
                    $mog = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Могилев';
                }
                elseif((int)$column[1]>=4){
                    $img =  '<img src=/images/icon/ostatki_mnogo.svg class="ostatki_malo">';
                    $txttooltip = "Осталось много";
                    $mog = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Могилев';
                }else{
                    $img = '<img src=/images/icon/ostatki_dostatochno.svg class="ostatki_malo">';
                    $txttooltip = "Есть в наличии";
                    $mog = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Могилев';
                };

            }
            if($column['0'] > 0) {
                if((int)$column[0]<=1){
                    $img = '<img src=/images/icon/ostatki_malo.svg class="ostatki_malo">';
                    $txttooltip = "Остался последний";
                    $minsk = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Минск';
                }
                elseif((int)$column[0]>=4){
                    $img =  '<img src=/images/icon/ostatki_mnogo.svg class="ostatki_malo">';
                    $txttooltip = "Осталось много";
                    $minsk = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Минск';
                }else{
                    $img = '<img src=/images/icon/ostatki_dostatochno.svg class="ostatki_malo">';
                    $txttooltip = "Есть в наличии";
                    $minsk = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Минск';
                };
            }
            if($column['2'] > 0) {
                if((int)$column[2]<=1){
                    $img = '<img src=/images/icon/ostatki_malo.svg class="ostatki_malo">';
                    $txttooltip = "Остался последний";
                    $orsha = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Орша';
                }
                elseif((int)$column[2]>=4){
                    $img =  '<img src=/images/icon/ostatki_mnogo.svg class="ostatki_malo">';
                    $txttooltip = "Осталось много";
                    $orsha = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Орша';
                }else{
                    $img = '<img src=/images/icon/ostatki_dostatochno.svg class="ostatki_malo">';
                    $txttooltip = "Есть в наличии";
                    $orsha = '<div class="tooltip">' . $img . '<span class="tooltiptext">' . $txttooltip . '</span></div> г.Орша';
                };

            }
            if(count($column)==0){
                $view->_tmp_var_qtyattribute = "<div class='stock_in stockin_bold col-12 col-md-12 col-xs-12 text-red'>
        Нет в наличии</div>'";
            }else{
        $view->_tmp_var_qtyattribute = "<div class='stock_in stockin_bold col-12 col-md-12 col-xs-12'>
        в наличии в <span id=''>" . count($column) . "</span> магазин" . $endsh . " " . $mog ." ".$minsk." ".$orsha.'</div>';

            }
    }
}

?>