function xor(a, b) {
    return (a || b) && !(a && b);
}

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
		
		$('#goal_form').submit(function() {
    let isValid = true; // フォームの有効性を追跡するフラグ

    // ゴール名のバリデーション
    if ($('#goal-name').val() == '') {
        $('#goal-name-error').css('display', 'block');
        isValid = false; // 無効に設定
    } else {
        $('#goal-name-error').css('display', 'none');
    }

    // ゴール日付のバリデーション
    if ($('#goal-date').val() == '') {
        $('#goal-date-error').css('display', 'block');
        isValid = false; // 無効に設定
    } else {
        $('#goal-date-error').css('display', 'none');
    }

    return isValid; // すべてが有効であれば true を返す
});

    	
    	$('#plan_form').submit(function() {
    
    // エラーメッセージの初期化
    $('.error').css('display', 'none');

    // バリデーションフラグ
    let isValid = true;

    // バリデーション関数
    function displayError(element, message) {
        $(element).css('display', 'block').text(message);
        isValid = false;
    }

    if ($('#plan-name').val() == '') {
        displayError('#plan-name-error', 'プラン名を入力してください。');
    }

    if ($('#plan-date-start').val() == '') {
        displayError('#plan-date-error', '開始日を入力してください。');
    }

    if ($('#plan-date-end').val() == '') {
        displayError('#plan-date-error', '終了日を入力してください。');
    }
    
    function isNumber(val) {
    // 空文字列を許可し、正の整数（1以上）の場合のみtrueを返す
    return val === '' || new RegExp('^(?:[1-9][0-9]*)$').test(val);
    }

    if (!isNumber($('#plan-integer').val())) { // 修正
        displayError('#plan-integer-error', '自然数を入力してください。');
    }

    function rangeStartExist() {
        return $('#plan-range-start').val() !== '';
    }

    function rangeEndExist() {
        return $('#plan-range-end').val() !== '';
    }

    function rangeUnitExist() {
        return $('#plan-range-unit').val() !== '';
    }

    if (rangeStartExist() !== rangeEndExist()) {
        displayError('#plan-range-error', '両方選択してください。');
    }

    if (rangeUnitExist() && !rangeStartExist()) {
        displayError('#plan-range-error', '単位を消すか、範囲を選択してください。');
    }


    if ($('#plan-interval').val() == '') {
        displayError('#plan-interval-error', 'タスクの間隔を入力してください。');
    } else if (!isNumber($('#plan-interval').val())) {
        displayError('#plan-interval-error', '可能な数値を入力してください。');
    }

    if ($('#plan-goal').val() == '') {
        displayError('#plan-goal-error', '目標を入力してください。');
    }

    return isValid; // フォームが有効な場合のみ送信
});


})();