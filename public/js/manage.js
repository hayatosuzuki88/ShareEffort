"use strict";

;
(function() {
	$("#goal_create_button").click(function() {
		$("#goal_create").css("display", "block");
		$("#calendar").css("display", "none");

	});

	$("#close_goal_create").click(function() {
		$("#goal_create").css("display", "none");
		$("#calendar").css("display", "block");
	});

	$("#plan_create_button").click(function() {
		$("#plan_create").css("display", "block");
		$("#calendar").css("display", "none");
	});

	$("#close_plan_create").click(function() {
		$("#plan_create").css("display", "none");
		$("#calendar").css("display", "block");
	});


});

;
(function() {
	$(function() {

		let display_size = 0;
		if (window.matchMedia('(max-width: 768px)').matches) {
			//スマホ処理
			display_size = 1;
		} else if (window.matchMedia('(max-width: 1200px)').matches) {

			display_size = 2;
		} else {
			//PC処理
			display_size = 3;
		}

		const my_goal_size = $('.my_goal_plan').length;

		$('.my_goal_plan').eq(0).addClass('goal_active');

		let my_plan_size = $('.goal_active .my_plan').length;

		for (let i = 0; i < my_plan_size && i < display_size; i++) {
			$('.goal_active .my_plan').eq(i).addClass('active');
		}

		if (my_plan_size == 0) {
			$('.goal_active .next_plan_button').css('display', 'none');
			$('.goal_active .prev_plan_button').css('display', 'none');
		}

		if (my_plan_size < display_size) {
			$('.goal_active .next_plan_button').css('display', 'none');
		}

		if (my_goal_size <= 1) {
			$('.next_goal_button').css('display', 'none');
			$('.prev_goal_button').css('display', 'none');
		}

		$('.next_goal_button').click(function() {
			$('.goal_active').next().addClass('goal_active');
			$('.goal_active').eq(0).removeClass('goal_active');

			if ($('.my_goal_plan').eq(my_goal_size - 1).hasClass('goal_active')) {
				$('.next_goal_button').css('display', 'none');
			}
			if (!$('.my_goal_plan').eq(0).hasClass('goal_active')) {
				$('.prev_goal_button').css('display', 'inline-block');
			}

			my_plan_size = $('.goal_active .my_plan').length;

			for (let i = 0; i < my_plan_size && i < display_size; i++) {
				$('.goal_active .my_plan').eq(i).addClass('active');
			}

			if (my_plan_size == 0) {
				$('.goal_active .next_plan_button').css('display', 'none');
				$('.goal_active .prev_plan_button').css('display', 'none');
			}

			if (my_plan_size < display_size) {
				$('.goal_active .next_plan_button').css('display', 'none');
			}
		});

		$('.prev_goal_button').click(function() {
			$('.goal_active').eq(0).prev().addClass('goal_active');
			$('.goal_active').eq(1).removeClass('goal_active');

			if ($('.my_goal_plan').eq(0).hasClass('goal_active')) {
				$('.prev_goal_button').css('display', 'none');
			}
			if (!$('.my_goal_plan').eq(my_goal_size - 1).hasClass('goal_active')) {
				$('.next_goal_button').css('display', 'inline-block');
			}
			my_plan_size = $('.goal_active .my_plan').length;
			for (let i = 0; i < my_plan_size && i < display_size; i++) {
				$('.goal_active .my_plan').eq(i).addClass('active');
			}

			if (my_plan_size == 0) {
				$('.goal_active .next_plan_button').css('display', 'none');
				$('.goal_active .prev_plan_button').css('display', 'none');
			}

			if (my_plan_size < display_size) {
				$('.goal_active .next_plan_button').css('display', 'none');
			}
		});


		$('.goal_active .next_plan_button').click(function() {
			$('.active').eq(display_size - 1).next().addClass('active');
			$('.active').eq(0).removeClass('active');

			if ($('.goal_active .my_plan').eq(my_plan_size - 1).hasClass('active')) {
				$('.goal_active .next_plan_button').css('display', 'none');
			}
			if (!$('.goal_active .my_plan').eq(0).hasClass('active')) {
				$('.goal_active .prev_plan_button').css('display', 'inline-block');
			}
		});

		$('.goal_active .prev_plan_button').click(function() {
			$('.active').eq(0).prev().addClass('active');
			$('.active').eq(display_size).removeClass('active');

			if ($('.goal_active .my_plan').eq(0).hasClass('active')) {
				$('.goal_active .prev_plan_button').css('display', 'none');
			}
			if (!$('.goal_active .my_plan').eq(my_plan_size - 1).hasClass('active')) {
				$('.goal_active .next_plan_button').css('display', 'inline-block');
			}
		});

	});

})();
