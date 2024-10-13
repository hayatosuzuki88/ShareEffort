;(function(){
		// ゴールとプランのページ送り
		let display_size = 0; // 表示枚数
		if (window.matchMedia('(max-width: 850px)').matches) {
			//スマホ
			display_size = 1;
		} else if (window.matchMedia('(max-width: 1200px)').matches) {
			display_size = 2;
		} else if (window.matchMedia('(max-width: 1300px)').matches) {
			// タブレット
			display_size = 3;
		} else {
			//PC
			display_size = 1;
		}

		const my_goal_size = $('.my_goal').length;
		for (let i = 0; i < my_goal_size && i < display_size; i++) {
			$('.my_goal').eq(i).addClass('goal_active');
		}

		if (my_goal_size <= display_size) {
			$('.next_goal_button').css('display', 'none');
		}
		if (my_goal_size == 0) {
			$('.next_goal_button').css('display', 'none');
			$('.prev_goal_button').css('display', 'none');
		}


		$('.next_goal_button').click(function() {
			$('.goal_active').eq(display_size - 1).next().addClass('goal_active');
			$('.goal_active').eq(0).removeClass('goal_active');

			if ($('.my_goal').eq(my_goal_size - 1).hasClass('goal_active')) {
				$('.next_goal_button').css('display', 'none');
			}
			if (!$('.my_goal').eq(0).hasClass('goal_active')) {
				$('.prev_goal_button').css('display', 'flex');
			}
		});

		$('.prev_goal_button').click(function() {
			$('.goal_active').eq(0).prev().addClass('goal_active');
			$('.goal_active').eq(display_size).removeClass('goal_active');

			if ($('.my_goal').eq(0).hasClass('goal_active')) {
				$('.prev_goal_button').css('display', 'none');
			}
			if (!$('.my_goal').eq(my_goal_size - 1).hasClass('goal_active')) {
				$('.next_goal_button').css('display', 'flex');
			}
		});


		const today_task_size = $('.today_task').length;
		for (let i = 0; i < today_task_size && i < display_size; i++) {
			$('.today_task').eq(i).addClass('task_active');
		}

		if (today_task_size <= display_size) {
			$('.next_task_button').css('display', 'none');
		}
		if (today_task_size == 0) {
			$('.next_task_button').css('display', 'none');
			$('.prev_task_button').css('display', 'none');
		}


		$('.next_task_button').click(function() {
			$('.task_active').eq(display_size - 1).next().addClass('task_active');
			$('.task_active').eq(0).removeClass('task_active');

			if ($('.today_task').eq(today_task_size - 1).hasClass('task_active')) {
				$('.next_task_button').css('display', 'none');
			}
			if (!$('.today_task').eq(0).hasClass('task_active')) {
				$('.prev_task_button').css('display', 'flex');
			}
		});

		$('.prev_task_button').click(function() {
			$('.task_active').eq(0).prev().addClass('task_active');
			$('.task_active').eq(display_size).removeClass('task_active');

			if ($('.today_task').eq(0).hasClass('task_active')) {
				$('.prev_task_button').css('display', 'none');
			}
			if (!$('.today_task').eq(today_task_size - 1).hasClass('task_active')) {
				$('.next_task_button').css('display', 'flex');
			}
		});

		let routine_display = 0;
		if (window.matchMedia('(max-width: 300px)').matches) {
			routine_display = 3;
		} else if (window.matchMedia('(max-width: 350px)').matches) {
			routine_display = 4;
		} else if (window.matchMedia('(max-width: 400px)').matches) {
			routine_display = 5;
		} else if (window.matchMedia('(max-width: 450px)').matches) {
			routine_display = 6;
		} else if (window.matchMedia('(max-width: 500px)').matches) {
			routine_display = 7;
		} else if (window.matchMedia('(max-width: 600px)').matches) {
			routine_display = 3;
		} else if (window.matchMedia('(max-width: 680px)').matches) {
			routine_display = 4;
		} else if (window.matchMedia('(max-width: 760px)').matches) {
			routine_display = 5;
		} else if (window.matchMedia('(max-width: 840px)').matches) {
			routine_display = 6;
		} else if (window.matchMedia('(max-width: 920px)').matches) {
			routine_display = 7;
		} else if (window.matchMedia('(max-width: 1000px)').matches) {
			routine_display = 8;
		} else if (window.matchMedia('(max-width: 1080px)').matches) {
			routine_display = 9;
		} else {
			routine_display = 10;
		}

		const routing_friend_size = $('.routing_friend').length;
		for (let i = 0; i < routing_friend_size && i < display_size; i++) {
			$('.routing_friend').eq(i).addClass('routing_active');
		}

		if (routing_friend_size <= display_size) {
			$('.next_routing_button').css('display', 'none');
		}
		if (routing_friend_size == 0) {
			$('.next_routing_button').css('display', 'none');
			$('.prev_routing_button').css('display', 'none');
		}


		$('.next_routing_button').click(function() {
			$('.routing_active').eq(display_size - 1).next().addClass(
				'routing_active');
			$('.routing_active').eq(0).removeClass('routing_active');

			if ($('.routing_task').eq(routing_friend_size - 1).hasClass(
					'routing_active')) {
				$('.next_routing_button').css('display', 'none');
			}
			if (!$('.routing_friend').eq(0).hasClass('routing_active')) {
				$('.prev_routing_button').css('display', 'block');
			}
		});

		$('.prev_routing_button').click(function() {
			$('.routing_active').eq(0).prev().addClass('routing_active');
			$('.routing_active').eq(display_size).removeClass('routing_active');

			if ($('.routing_task').eq(0).hasClass('routing_active')) {
				$('.prev_routing_button').css('display', 'none');
			}
			if (!$('.routing_friend').eq(routing_friend_size - 1).hasClass(
					'routing_active')) {
				$('.next_routing_button').css('display', 'block')
			}
		});
})();
