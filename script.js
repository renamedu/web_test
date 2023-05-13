//Сохранение get параметра поиска при нажатии на кнопки сортировки по цене

window.addEventListener("load", (event) => {
  
    const params = new URLSearchParams(document.location.search);
    const filter = params.get("filter");
  
    const inputValue = document.getElementById('filter-input');
  
    if (filter) {
        inputValue.value = filter;
    }
  });
  