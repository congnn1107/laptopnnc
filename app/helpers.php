<?php

/**
 * In ra danh sách danh mục đa cấp cho thanh menu
 * 
 * Hàm này sẽ nhận vào một danh sách categories, sử dụng kỹ thuật đệ quy để duyệt và in ra các categories theo đúng trình tự cấp độ
 * @param int $template giá trị chỉ định sử dụng template (0: in ra select, 1: in ra menu)
 * @param mixed $categoriesList Danh sách categories ban đầu
 * @param int $selected Giá trị mặc định được select khi đưa vào danh sách các select options ở chức năng update
 * @param int $current_category Id của category đang được cập nhật
 * @param int $parent_id ID của anh mục cha
 * @param int $level  Cấp độ của danh mục
 * @return void Không trả giá trị
 * @author NNC - Nguyen Ngoc Cong
 * @version 0.2
 */
function showCategoriesMenu($template,$categoriesList,$selected=0,$current_category=0,$parent_id=0,$level=0){

        foreach($categoriesList->where("parent_id",$parent_id) as $category){
            if($category->id==$current_category) return;
            //check selected
            $str = $category->id==$selected?"selected":"";
            //html template here
            if($template==0){
                echo getSelectOptionTemplate($category,$str,$level);
            }else{
                echo getNavMenuTemplate($category);
            }

            if($category->childs){
                showCategoriesMenu($template,$category->childs,$selected,$current_category,$category->id,$level+1);
            }
        }
}
/**
 * Lấy mẫu options cho select các category
 * Hàm này nhận vào các tham số và trả ra thẻ option chứa các thuộc tính của category
 * @param Category $category Đối tượng category
 * @param string $str Chuỗi đánh dấu selected cho option
 * @param int $level cấp độ hiện tại của category
 * @return string Một thẻ html option
 * @author NNC
 * @version 0.1
 */
function getSelectOptionTemplate($category,$str,$level){
    return '<option value="'.$category->id.'"'.$str.'>'.str_repeat("&nbsp;",$level*3).$category->name.'</option>';
}
/**
 * Lấy mẫu Menu item cho các categories ở nav bar menu
 * Hàm này tạo ra các thẻ menu item xếp theo thứ tự, cấp độ để hiển thị các categories trên menu thanh nav
 * @param Category $category Một đối tượng category
 * @return string Thẻ HTML
 * @author NNC
 * @version 0.0
 */
function getNavMenuTemplate($category){
    return "";
}
