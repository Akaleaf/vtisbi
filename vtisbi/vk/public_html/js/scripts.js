
let sizeBox = document.querySelector('.description_box ul');

sizeBox.onclick = function() {
	
/*	var request = new XMLHttpRequest();
request.open('GET','../actions/AJAX_DB.php?w="+window.body',true);
request.setRequestHeader("Content-Type", "application/json");

// 4. Подписка на событие onreadystatechange и обработка его с помощью анонимной функции
request.addEventListener('readystatechange', function() {

  // если состояния запроса 4 и статус запроса 200 (OK)
  if ((request.readyState==4) && (request.status==200)) {
    // например, выведем объект XHR в консоль браузера

  for (let i of text) {
i.onclick = function(){

	 window.textLi = this.firstChild.textContent;
     console.log(textLi);
  window.body = JSON.stringify(textLi);
    p.innerHTML = request.responseText;

}}

  }
}); 
// 5. Отправка запроса на сервер
request.send(); 

*/


}//onclick


 
sizeBox.addEventListener('click', function(e) {

	           const p = document.querySelector('.description_box ul + p');
               const ListItem = document.querySelectorAll('.description_box ul > li ');
	           const target = e.target;

	           Array.from(ListItem).forEach(item => {
  	           item.classList.remove('active');
  })
               target.classList.add('active');

    for (let i of ListItem) {
i.onclick = function(){
	            window.textProductName = document.querySelector('.description_box p').textContent;
	            window.textListItem = this.firstChild.textContent;
$.ajax({
                url: '../actions/AJAX_DB.php', 
                method: 'post',
                data: {ListItemText: window.textListItem,ProductNameText:window.textProductName},
                success: function(result) {
                p.innerHTML = result ;       
                                        }   
        });

                            }}
})
