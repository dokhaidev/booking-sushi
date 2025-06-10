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


http://127.0.0.1:8000/api/food/category/{id} POST
{
  "name": "Sushi Cá Hồi",
  "jpName":null,
  "group_id":null,  
  "price": 120000,
  "category_id": 1,
  "description": "Sushi cá hồi tươi ngon",
  "image": "sushi.jpg"
}


