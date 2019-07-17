		var slength = 5;
		var sinx = 1;
		var sliderDelay = 10000; 
		var sliderInterval = setInterval(sliderLeft, sliderDelay);
		var silength = $(".slider-item").length;
		
		$(function(){
			if(sessionStorage.getItem("sinx")){
				sinx = sessionStorage.getItem("sinx");
				
			}
			
			$(".slider-item").css("left", -1 *  $("body").width() * 7.9 / 100 + ($("body").width() * 47.3 / 100 * -1 * (sinx - 1)));
			
			$(".slider-item").addClass("si-side");
			
			$(".slider-item:eq("+ (sinx) + ")").removeClass("si-side");
			$(".slider .right-button").click(function(){
				clearInterval(sliderInterval);
				sliderInterval = setInterval(sliderLeft, sliderDelay);
				sliderLeft();
				
			});
			$(".slider .left-button").click(function(){
				clearInterval(sliderInterval);
				sliderInterval = setInterval(sliderLeft, sliderDelay);
				if(sinx > 0)
					sinx--;
				else
					sinx = silength - 1;
				sessionStorage.setItem("sinx", sinx);
				$(".slider-item").addClass("si-side");
				$(".slider-item:eq(" + (sinx) + ")").removeClass("si-side");
				$(".slider-item").css("left", -1 *  $("body").width() * 7.9 / 100 + ($("body").width() * 47.3 / 100 * -1 * (sinx - 1)));
				
			});
		});
		
		function sliderLeft(){
			if(sinx < silength -1)
				sinx++;
			else
				sinx = 0;
			sessionStorage.setItem("sinx", sinx);
			$(".slider-item:eq(" + (sinx - 1) + ")").addClass("si-side");
			$(".slider-item:eq(" + (sinx) + ")").removeClass("si-side");
				//var amountYuzde = -1 * $("body").width() * 7.9 / 100 + ($("body").width() * 47.3 / 100 * -1 * (sinx - 1));
				//var amount = -1 * 150 + (900 * -1 * (sinx - 1));
				//alert(amountYuzde + "//" + amount + "//" +  $("body").width() * 7.9 / 100 + "//" + $("body").width() * 47.3 / 100);
			$(".slider-item").css("left", -1 * $("body").width() * 7.9 / 100 + ($("body").width() * 47.3 / 100 * -1 * (sinx - 1)));
		}