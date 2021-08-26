<?php

/**
 * In ra danh sách danh mục đa cấp cho thanh menu
 * 
 * Hàm này sẽ nhận vào một danh sách categories, sử dụng kỹ thuật đệ quy để duyệt và in ra các categories theo đúng trình tự cấp độ
 * 
 * @param mixed $categoriesList Danh sách categories ban đầu
 * @param int $parent_id ID của anh mục cha
 * @param int $level  Cấp độ của danh mục
 * @return void Không trả giá trị
 * @author NNC - Nguyen Ngoc Cong
 * @version 0.1
 */
function showCategoriesMenu($categoriesList,$parent_id=0,$level=0){

        foreach($categoriesList->where("parent_id",$parent_id) as $category){

            //html template here
            echo '<option value="'.$category->id.'">'.str_repeat("-",$level*3).$category->name.'</option>';

            if($category->childs){
                showCategoriesMenu($category->childs,$category->id,$level+1);
            }
        }
}
