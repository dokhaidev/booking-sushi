lấy ra danh sách food
http://127.0.0.1:8000/api/foods GET

=====================
thêm món ăn 
http://127.0.0.1:8000/api/food/insertfood POST

{
  "name": "Sushi Cá Hồi",
  "jpName":null,
  "group_id":null,  
  "price": 120000,
  "category_id": 1,
  "description": "Sushi cá hồi tươi ngon",
  "image": "sushi.jpg"
}

=========================
cập nhập món ăn 
http://127.0.0.1:8000/api/food/category/{id} PUT
{
  "name": "Sushi Cá Hồi",
  "jpName":null,
  "group_id":null,  
  "price": 120000,
  "category_id": 1,
  "description": "Sushi cá hồi tươi ngon",
  "image": "sushi.jpg"
}
=========================
lấy ra tất cả combo
http://127.0.0.1:8000/api/combos GET

======================

lấy chi tiết combo

http://127.0.0.1:8000/api/combos/{id} GET



=========================

Thêm combo


http://127.0.0.1:8000/api/combo/insert-combos POST



{
    "name": "Combo Sushi Đặc Biệt",
    "image": "combo1.jpg",
    "description": "Combo sushi tổng hợp cho 2 người",
    "price": 299000,
    "status": true,
    "items": [
        { "food_id": 1, "quantity": 2 },
        { "food_id": 2, "quantity": 1 }
    ]
}

=========================

cập nhập combo


http://127.0.0.1:8000/api/update-combo/{id} PUT


{
    "name": "Combo Sushi Siêu Cấp",
    "image": "combo2.jpg",
    "description": "Combo sushi cho nhóm bạn",
    "price": 399000,
    "status": false,
    "items": [
        { "food_id": 3, "quantity": 3 },
        { "food_id": 4, "quantity": 2 }
    ]
}
=======================
lấy ra tất cả order
http://127.0.0.1:8000/api/orders GET

=======================
lấy ra chi tiết order(orderitem)
http://127.0.0.1:8000/api/orders/{id} GET

=======================
cập nhập trạng thái đơn hàng
http://127.0.0.1:8000/api/order/update-status/{id} PUT


{
   "status":"success"
}

==========================
cập nhập trạng thái chi tiết đơn hàng
http://127.0.0.1:8000/api/orderitems/update-status/{id} PUT


{
   "status":"success"
}
===========================
lấy ra danh sách người dungf
http://127.0.0.1:8000/api/admin/customers GET
