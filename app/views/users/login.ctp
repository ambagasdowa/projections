<?php
//     pr($empresas);
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300);
body {
  background: #50a3a2;
  background: -webkit-linear-gradient(top left, #777 0%, #fff 100%);
  background: linear-gradient(to bottom right, #777 0%, #fff 100%);
}
.body {
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  font-weight: 300;
}
.body ::-webkit-input-placeholder {
  /* WebKit browsers */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  font-weight: 300;
}
.body :-moz-placeholder {
  /* Mozilla Firefox 4 to 18 */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  opacity: 1;
  font-weight: 300;
}
.body ::-moz-placeholder {
  /* Mozilla Firefox 19+ */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  opacity: 1;
  font-weight: 300;
}
.body :-ms-input-placeholder {
  /* Internet Explorer 10+ */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  font-weight: 300;
}
.wrapper {
/*   background: #50a3a2; */
/*   background: -webkit-linear-gradient(top left, #50a3a2 0%, #53e3a6 100%); */
/*   background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%); */
/*  background: #50a3a2;
  background: -webkit-linear-gradient(top left, #777 0%, #fff 100%);
  background: linear-gradient(to bottom right, #777 0%, #fff 100%);*/
  position: absolute;
  top: 30%;
  left: 0;
  width: 100%;
  height: 600px;
  margin-top: -200px;
  overflow: hidden;
}
.wrapper.form-success .container h1 {
  -webkit-transform: translateY(85px);
      -ms-transform: translateY(85px);
          transform: translateY(85px);
}
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 80px 0;
  height: 400px;
  text-align: center;
}
.container h1 {
  font-size: 40px;
  -webkit-transition-duration: 1s;
          transition-duration: 1s;
  -webkit-transition-timing-function: ease-in-put;
          transition-timing-function: ease-in-put;
  font-weight: 200;
}
form {
  padding: 20px 0;
  position: relative;
  z-index: 2;
}
form input {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: 0;
  border: 1px solid rgba(255, 255, 255, 0.4);
  background-color: rgba(255, 255, 255, 0.2);
  width: 250px;
  border-radius: 3px;
  padding: 10px 15px;
  margin: 0 auto 10px auto;
  display: block;
  text-align: center;
  font-size: 18px;
  color: white;
  -webkit-transition-duration: 0.25s;
          transition-duration: 0.25s;
  font-weight: 300;
}


form input:hover {
  background-color: rgba(255, 255, 255, 0.4);
}
form input:focus {
  background-color: white;
  width: 300px;
  color: #53e3a6;
}
form button {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: 0;
  background-color: white;
  border: 0;
  padding: 10px 15px;
  color: #53e3a6;
  border-radius: 3px;
  width: 250px;
  cursor: pointer;
  font-size: 18px;
  -webkit-transition-duration: 0.25s;
          transition-duration: 0.25s;
}
form button:hover {
  background-color: #f5f7f9;
}
.bg-bubbles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}
.bg-bubbles li {
  position: absolute;
  list-style: none;
   display: block; 
/*  width: 40px;
  height: 40px; */
/*   background-color: rgba(255, 255, 255, 0.15); */
  bottom: -160px;
  -webkit-animation: square 25s infinite;
  animation: square 25s infinite;
  -webkit-transition-timing-function: linear;
  transition-timing-function: linear;
}
.bg-bubbles li:nth-child(1) {
  left: 10%;
}
.bg-bubbles li:nth-child(2) {
  left: 20%;
/*  width: 80px;
  height: 80px;*/
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
  -webkit-animation-duration: 17s;
          animation-duration: 17s;
}
.bg-bubbles li:nth-child(3) {
  left: 25%;
  -webkit-animation-delay: 4s;
          animation-delay: 4s;
}
.bg-bubbles li:nth-child(4) {
  left: 40%;
/*  width: 60px;
  height: 60px;*/
  -webkit-animation-duration: 22s;
          animation-duration: 22s;
/*   background-color: rgba(255, 255, 255, 0.25); */
}
.bg-bubbles li:nth-child(5) {
  left: 70%;
}
.bg-bubbles li:nth-child(6) {
  left: 80%;
/*  width: 120px;
  height: 120px;*/
  -webkit-animation-delay: 3s;
          animation-delay: 3s;
/*   background-color: rgba(255, 255, 255, 0.2); */
}
.bg-bubbles li:nth-child(7) {
  left: 32%;
/*  width: 160px;
  height: 160px;*/
  -webkit-animation-delay: 7s;
          animation-delay: 7s;
}
.bg-bubbles li:nth-child(8) {
  left: 55%;
/*  width: 20px;
  height: 20px;*/
  -webkit-animation-delay: 15s;
          animation-delay: 15s;
  -webkit-animation-duration: 40s;
          animation-duration: 40s;
}
.bg-bubbles li:nth-child(9) {
  left: 25%;
/*  width: 10px;
  height: 10px;*/
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
  -webkit-animation-duration: 40s;
          animation-duration: 40s;
/*   background-color: rgba(255, 255, 255, 0.3); */
}
.bg-bubbles li:nth-child(10) {
  left: 90%;
/*  width: 160px;
  height: 160px;*/
  -webkit-animation-delay: 11s;
          animation-delay: 11s;
}
@-webkit-keyframes square {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
  }
}
@keyframes square {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
  }
}

</style>


<style>
/* select */

.select-hidden {
  display: none;
  visibility: hidden;
  padding-right: 10px;
}

.select {
  cursor: pointer;
  display: inline-block;
  position: relative;
  font-size: 18px;
  color: #fff;
  width: 250px;
  height: 40px;
}

.select-styled {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
/*   background-color: #c0392b; */
  padding: 8px 15px;
  -moz-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  -webkit-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
  
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: 0;
  border: 1px solid rgba(255, 255, 255, 0.4);
  background-color: rgba(255, 255, 255, 0.2);
  width: 250px;
  border-radius: 3px;
/*   padding: 10px 15px; */
/*   margin: 0 auto 10px auto; */
  display: block;
  text-align: center;
  font-size: 18px;
  color: white;
/*  -webkit-transition-duration: 0.25s;
          transition-duration: 0.25s;*/
  font-weight: 300;
}
.select-styled:after {
  content: "";
  width: 0;
  height: 0;
  border: 7px solid transparent;
  border-color: #fff transparent transparent transparent;
  position: absolute;
  top: 16px;
  right: 10px;
}
.select-styled:hover {
/*   background-color: #b83729; */
   background-color: rgba(255, 255, 255, 0.4);
}
.select-styled:active, .select-styled.active {
  background-color: rgba(255, 255, 255, 0.4);
/*   background-color: white; */
/*   color: #53e3a6; */
	color:#fff;
}
.select-styled:active:after, .select-styled.active:after {
  top: 9px;
  border-color: transparent transparent #fff transparent;
}

.select-options {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  left: 0;
  z-index: 999;
  margin: 0;
  padding: 0;
  list-style: none;
/*   background-color: #ab3326; */
/*   border: 1px solid rgba(255, 255, 255, 0.4); */
  background-color: #ccc;
/*   background-color: rgba(255, 255, 255, 0.4); */
}
.select-options li {
  margin: 0;
  padding: 12px 0;
  text-indent: 15px;
/*   border-top: 1px solid #962d22; */
  border-top: 1px solid rgba(255, 255, 255, 0.4);
  -moz-transition: all 0.15s ease-in;
  -o-transition: all 0.15s ease-in;
  -webkit-transition: all 0.15s ease-in;
  transition: all 0.15s ease-in;
}
.select-options li:hover {
/*   color: #c0392b; */
  color:#aaa;
  background: #fff;
}
.select-options li[rel="hide"] {
  display: none;
}
</style>
    


<div class="body">
<div class="wrapper">
	<div class="container">
		<div >
		<?php 
			echo $html->image("forms/login/gst.png",
					      array("width"=>145,
						    "height"=>60,
					      )
				);
		?>
		</div>
		<h2 class="form-signin-heading"><span>Inicio de Sesi&oacute;n</span></h2>
		
<!-- 		<form class="form"> -->
		<?php 
// 				echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' =>'login'),
// 										'class'=>'form')
// 									);
				echo $form->create('User', array('action' => 'login','class'=>'form'));
		?>
		<?php
		    // use number_id too
			e($form->input('username',
					array(
						'type'=>'text',
						'label'=>false,
// 						'class'=>'form-control',
						'placeholder'=>'Usuario',
						'required'=>'',
						'autofocus'=>''
					)
				)
			);
		?>
		<?php
			e($form->input('password',
					array(
						'type'=>'password',
						'label'=>false,
// 						'class'=>'form-control',
						'placeholder'=>'Password',
						'required'=>'',
						'autofocus'=>''
					)
				)
			);
		?>
        <?php 
			e($form->input('id_empresa',
					array(
						 "label"=>false,
					     'type'=>'select',
					     'options'=>$empresas,
					     'class'=>'form-control'
					)
				)
			);
		?>
      <p></p>
      <?php //echo $form->button('Entrar',array('id'=>'login-button')); ?>
      <?php echo $form->button('Entrar'); ?>

<?php echo $form->end(); ?>
	</div>

	<ul class="bg-bubbles">
		<li>
			<?php 
	// 			echo $html->image("forms/login/gst_gray.png"/*,
	// 					      array("width"=>280,
	// 						    "height"=>10,
	// 					      )*/
	// 				);
			?>
		</li>
		<li><!--<i class="fa fa-circle"></i>--></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div> 
</div>

<script>
		require(['jquery', 'bootstrap'], function($) {
			$(document).ready(function () {
				$("#login-button").click(function(event){
						event.preventDefault();
					
					$('form').fadeOut(500);
					$('.wrapper').addClass('form-success');
				});
				
				/*
				Reference: http://jsfiddle.net/BB3JK/47/
				*/

				$('select').each(function(){
					var $this = $(this), numberOfOptions = $(this).children('option').length;
				
					$this.addClass('select-hidden'); 
					$this.wrap('<div class="select"></div>');
					$this.after('<div class="select-styled"></div>');

					var $styledSelect = $this.next('div.select-styled');
					$styledSelect.text($this.children('option').eq(0).text());
				
					var $list = $('<ul />', {
						'class': 'select-options'
					}).insertAfter($styledSelect);
				
					for (var i = 0; i < numberOfOptions; i++) {
						$('<li />', {
							text: $this.children('option').eq(i).text(),
							rel: $this.children('option').eq(i).val()
						}).appendTo($list);
					}
				
					var $listItems = $list.children('li');
				
					$styledSelect.click(function(e) {
						e.stopPropagation();
						$('div.select-styled.active').each(function(){
							$(this).removeClass('active').next('ul.select-options').hide();
						});
						$(this).toggleClass('active').next('ul.select-options').toggle();
					});
				
					$listItems.click(function(e) {
						e.stopPropagation();
						$styledSelect.text($(this).text()).removeClass('active');
						$this.val($(this).attr('rel'));
						$list.hide();
						//console.log($this.val());
					});
				
					$(document).click(function() {
						$styledSelect.removeClass('active');
						$list.hide();
					});

				});
			});
		});

</script>