  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script>
  	// Menu toggle
  	let toggle = document.querySelector('.toggle');
  	let navigation = document.querySelector('.navigation');
  	let main = document.querySelector('.main');

  	toggle.onclick = function() {
  		navigation.classList.toggle('active');
  		main.classList.toggle('active');
  	};

  	// add hovered class in selected list item
  	let list = document.querySelectorAll('.navigation li');
  	function activeLink() {
  		list.forEach((item) =>
  		item.classList.remove('hovered'));
  		this.classList.add('hovered');
  	}
  	list.forEach((item) =>
  		item.addEventListener('mouseover',activeLink));
  </script>