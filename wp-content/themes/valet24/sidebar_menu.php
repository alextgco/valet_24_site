<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 09.08.2016
 * Time: 21:47
 */
?>


<!--                    -->


                    <?php




                    foreach($data as $k=>$v){
                        if(!$v[array_search('parent_category_id', $columns)]){
                            $dataLevel1[] = array(
                                'id' => $v[array_search('id', $columns)],
                                'name' => $v[array_search('name', $columns)],
                                'parent' => $v[array_search('parent_category_id', $columns)]
                            );
                        }else {
                            $dataChilds[] = array(
                                'id' => $v[array_search('id', $columns)],
                                'name' => $v[array_search('name', $columns)],
                                'parent' => $v[array_search('parent_category_id', $columns)]
                            );
                        }


                    };


//                    $tree = array();
//                    foreach ($dataset as $id => &$node) {
//                        //Если нет вложений
//                        if (!$node['parent']){
//                            $tree[$node['id']] = &$node;
//                        }else{
//                            //Если есть потомки то перебераем массив
//                            $dataset[$node['parent']]['childs'][$node['id']] = &$node;
//                        }
//                    }

                    //var_export($dataChilds);



                    ?>


<!--                    --><?php
//
//                        echo '<ul>';
//
////
////                    $arr = array();
////
////                    array_push('asa',$arr);
//
//                    foreach($data as $node => $cat) {
//
//                        foreach($data as $node1 => $cat1) {
//                            if ($node == $node1)
//                            {
//                                continue;
//                            }
//                            if($cat1['parent_category_id'] == $cat['id'] )
//                            {
//                                array_push($cat['children'], $cat1);
//                                break;
//                            }
//                        }
//                    }
//
//                    function generate_tree($data, $node)
//                    {
//
//                        var_dump($data);
//
//                        echo count($data[$node]['children']);
//
//                        if($node == count($data) - 1)
//                        {
//                            return;
//                        }
//                        generate_tree($data, $node++);
//                        return;
//
//                        if(count($data[$node]['children'])!= 0)
//                        {
//                            echo '<li class=""><a href="" onclick="return false;">
//                                <div class="root-category-image-holder"><img src="<?php echo get_stylesheet_directory_uri() ?>
<!--                    \/assets/img/cat-2.jpg"></div>-->
<!--//                                <div class="menu-title">'.$data[$node]['name'].'HUI</div>-->
<!--//                            </a>';-->
<!--//                            echo '<ul class="sub-menu">';-->
<!--//                            foreach($data[$node]['children'] as $node1 => $cat)-->
<!--//                            {-->
<!--//                                generate_tree($data[$node]['children'], $node1);-->
<!--//                            }-->
<!--//                            echo '</ul>';-->
<!--//                            echo '</li>';-->
<!--//                        }-->
<!--//                        else {-->
<!--//-->
<!--//                            echo '<li class="menu-item"><a href="#" onclick="return false;">' . $data[$node]['name'] . 'inner</a></li>';-->
<!--//                        }-->
<!--//-->
<!--//-->
<!--//                        if($node == count($data) - 1)-->
<!--//                        {-->
<!--//                            return;-->
<!--//                        }-->
<!--//-->
<!--//-->
<!--//-->
<!--//                        generate_tree($data, $node++);-->
<!--//-->
<!--//-->
<!--//                    }-->
<!--//-->
<!--//                    echo '<ul id="sidebar-categories-menu" class="page-sidebar-menu">';-->
<!--//-->
<!--//                    generate_tree($data, 0);-->
<!--//-->
<!--//                    echo '</ul>';-->

<!--                    echo '------------------------------------------------------';-->
<!---->
<!--                        foreach($data as $node => $cat) {-->
<!---->
<!--                            if ( strlen($cat[array_search('parent_category_id', $columns)]) > 0){-->
<!---->
<!--                                echo '<li>' . $cat[array_search('parent_category_id', $columns)] . ' -- ' . $cat[array_search('name', $columns)] . '</li>';-->
<!---->
<!--                            }else{-->
<!---->
<!--                            }-->
<!--                        }-->
<!---->
<!--                        echo '</ul>';-->
<!--                    ?>-->





<ul id="sidebar-categories-menu" class="page-sidebar-menu">

    <?php foreach($dataLevel1 as $item1):?>

        <?php

        $is_parent_cat = ($root_category_id == $item1['id'])? 'open' : '111';

        ?>


        <li class="<?php echo $is_parent_cat ?>">

            <a href="" onclick="return false;">
                <div class="menu-title" id="<?php echo $item1['id'] ?>"><?php echo $item1['name'] ?></div>
            </a>

                <ul class="sub-menu">

                    <?php

                    $count = 0;

                    ?>

                    <?php foreach($dataChilds as $item2):?>

                        <?php if($item2['parent'] == $item1['id']):?>

                            <li class="menu-item">

                                <?php

                                $is_curr_cat = ($category_id == $item2['id'])? 'active' : '';
                                $count++;
                                ?>

                                <a href="/category_<?php echo $item2['id'] ?>/" class="<?php echo $is_curr_cat ?>"><?php echo $item2['name'] ?></a>

                            </li>

                        <?php endif ?>

                    <?php endforeach ?>

                    <?php

                    if($count == 0){

                        echo '<li class="empty-menu-item">Товары отсутствуют.</li>';

                    }

                    ?>

                </ul>


        </li>


    <?php endforeach ?>



</ul>

<!--                    -->