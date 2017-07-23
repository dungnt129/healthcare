$(function () {
	// Enable zoom for user image
	$('.user-image').zoomify();

	// Init numeric input
	$(".numeric").numeric();

	// Validate when submit form
	$("#basic_validate").submit(function() {
		// Validate
		var checkAcceptPrep = $('input[name=tab\\[1\\]\\[tuvanvien3\\]\\[accept_prep\\]]:checked').val();
		var otherReasonText = $("#tab1_tuvanvien3_otherReasonText");

		if(checkAcceptPrep == 2 && otherReasonText.val() == "") {
			alert("Hãy nhập lý do từ chối tham gia dự án PrEP");
			otherReasonText.focus();
			return false;
		}
	});

	/* Tab 1 */
	$('input[name=tab\\[1\\]\\[tuvanvien1\\]\\[checkCondition\\]]').change(function() {
        if (this.value == 1) {
            $("#div-bacsi").fadeIn();
			// Check condition to show tuvanvien3 div
			var bacsiCheckCondition = $('input[name=tab\\[1\\]\\[bacsi\\]\\[checkCondition\\]]:checked').val();
			if(bacsiCheckCondition == 1) {
				$("#div-tuvanvien3").fadeIn();
			}
        }
        else if (this.value == 2) {
            $("#div-bacsi").fadeOut();
			$("#div-tuvanvien3").fadeOut();
        }
    });

	$('input[name=tab\\[1\\]\\[bacsi\\]\\[checkCondition\\]]').change(function() {
        if (this.value == 1) {
			$("#div-tuvanvien3").fadeIn();
        }
        else if (this.value == 2) {
			$("#div-tuvanvien3").fadeOut();
        }
    });

	$('.tab1_tuvanvien1_accept').on('click', function () {

		$('.tab1_tuvanvien1_accept').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_sex').on('click', function () {

		$('.tab1_tuvanvien1_sex').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_isVietnamese').on('click', function () {

		$('.tab1_tuvanvien1_isVietnamese').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasHIVfriend').on('click', function () {

		$('.tab1_tuvanvien1_hasHIVfriend').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasSexForCash').on('click', function () {

		$('.tab1_tuvanvien1_hasSexForCash').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasGiangMaiInLastYear').on('click', function () {

		$('.tab1_tuvanvien1_hasGiangMaiInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab_1_tuvanvien1_hasLauInLastYear').on('click', function () {

		$('.tab_1_tuvanvien1_hasLauInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasChlamydiaInLastYear').on('click', function () {

		$('.tab1_tuvanvien1_hasChlamydiaInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasCondomWhenAssSex').on('click', function () {

		$('.tab1_tuvanvien1_hasCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex').on('click', function () {

		$('.tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasCocainInLastYear').on('click', function () {

		$('.tab1_tuvanvien1_hasCocainInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_hasPaidForPrEP').on('click', function () {

		$('.tab1_tuvanvien1_hasPaidForPrEP').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_howDoYouKnowPrep').on('click', function () {

		$('.tab1_tuvanvien1_howDoYouKnowPrep').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab1_tuvanvien1_howDoYouKnowPrep').on('click', function () {

		$('.tab1_tuvanvien1_howDoYouKnowPrep').not(this).attr('checked', false);

		$('#tab1_tuvanvien1_howDoYouKnowPrepText').val("");

		$.uniform.update();
	});

	$('#tab1_tuvanvien1_howDoYouKnowPrepText').on('change', function () {
		$('.tab1_tuvanvien1_howDoYouKnowPrep').attr('checked', false);
		$.uniform.update();
	});

	// Toggle sub question
	$("#tab1_tuvanvien1_howManySexFriends").on('keyup', function () {
		// init
		var inputHowManyAssSexFriends = $("#tab1_tuvanvien1_howManyAssSexFriends");
		var questionHowManyAssSexFriends = $("#question_tab1_tuvanvien1_howManyAssSexFriends");
		var questionHasCondomWhenAssSex = $("#question_tab1_tuvanvien1_hasCondomWhenAssSex");

		if ($(this).val() > 0) {
			// Clear old data
			inputHowManyAssSexFriends.val('');
			questionHowManyAssSexFriends.fadeIn();
		} else {
			questionHowManyAssSexFriends.fadeOut();
			questionHasCondomWhenAssSex.fadeOut();
		}
	});

	$("#tab1_tuvanvien1_howManyAssSexFriends").on('keyup', function () {
		var questionHasCondomWhenAssSex = $("#question_tab1_tuvanvien1_hasCondomWhenAssSex");
		var checkboxHasCondomWhenAssSex = $('.tab1_tuvanvien1_hasCondomWhenAssSex');

		if ($(this).val() > 0) {
			// Clear old data
			checkboxHasCondomWhenAssSex.attr('checked', false);
			$.uniform.update();

			questionHasCondomWhenAssSex.fadeIn();
		} else {
			questionHasCondomWhenAssSex.fadeOut();
		}
	});

	$('.tab1_tuvanvien3_accept_prep').on('click', function () {

		$('.tab1_tuvanvien3_accept_prep').not(this).attr('checked', false);

		$.uniform.update();

		if($(this).val() == 2 && $(this).attr('checked')) {
			$("#cancelReason").fadeIn();
		} else {
			$("#tab1_tuvanvien3_otherReasonText").val('');
			$("#cancelReason").fadeOut();
		}
	});
	/* End tab 1 */

	/* Tab 2, 3, 4, 5, 6, 7, 8 */
	var arrTabId = [2,3,4,5,6,7,8];

	arrTabId.forEach(function(id) {
		// Handle for input hasTieuChay
		$('.tab' + id + '_tuvanvien1_hasTieuChay').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasTieuChay').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasTired
		$('.tab' + id + '_tuvanvien1_hasTired').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasTired').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasPoisonGan
		$('.tab' + id + '_tuvanvien1_hasPoisonGan').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasPoisonGan').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasChangedEmotion
		$('.tab' + id + '_tuvanvien1_hasChangedEmotion').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasChangedEmotion').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasBuonNon
		$('.tab' + id + '_tuvanvien1_hasBuonNon').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasBuonNon').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasManNgua
		$('.tab' + id + '_tuvanvien1_hasManNgua').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasManNgua').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasNonMua
		$('.tab' + id + '_tuvanvien1_hasNonMua').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasNonMua').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasCondomWhenAssSex
		$('.tab' + id + '_tuvanvien1_hasCondomWhenAssSex').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasCondomWhenAssSex').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasAlwaysUseCondomWhenAssSex
		$('.tab' + id + '_tuvanvien1_hasAlwaysUseCondomWhenAssSex').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasAlwaysUseCondomWhenAssSex').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasCocainInLastYear
		$('.tab' + id + '_tuvanvien1_hasCocainInLastYear').on('click', function () {

			$('.tab' + id + '_tuvanvien1_hasCocainInLastYear').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input hasHIV
		$('.tab' + id + '_tuvanvien3_hasHIV').on('click', function () {

			$('.tab' + id + '_tuvanvien3_hasHIV').not(this).attr('checked', false);

			$.uniform.update();
		});

		// Handle for input otherReason
		$(".tab" + id + "_tuvanvien3_otherReason").on('click', function () {
			$(".tab" + id + "_tuvanvien3_otherReason").not(this).attr('checked', false);

			$("#tab" + id + "_tuvanvien3_otherReasonText").val("");

			$.uniform.update();
		});

		$("#tab" + id + "_tuvanvien3_otherReasonText").on('change', function () {
			$(".tab" + id + "_tuvanvien3_otherReason").attr('checked', false);
			$.uniform.update();
		});

		// Toggle sub question
		$("#tab" + id + "_tuvanvien1_howManySexFriends").on('keyup', function () {
			// init
			var inputHowManyAssSexFriends = $("#tab" + id + "_tuvanvien1_howManyAssSexFriends");
			var questionHowManyAssSexFriends = $("#question_tab" + id + "_tuvanvien1_howManyAssSexFriends");
			var questionHasCondomWhenAssSex = $("#question_tab" + id + "_tuvanvien1_hasCondomWhenAssSex");

			if ($(this).val() > 0) {
				// Clear old data
				inputHowManyAssSexFriends.val('');
				questionHowManyAssSexFriends.fadeIn();
			} else {
				questionHowManyAssSexFriends.fadeOut();
				questionHasCondomWhenAssSex.fadeOut();
			}
		});

		$("#tab" + id + "_tuvanvien1_howManyAssSexFriends").on('keyup', function () {
			var questionHasCondomWhenAssSex = $("#question_tab" + id + "_tuvanvien1_hasCondomWhenAssSex");
			var checkboxHasCondomWhenAssSex = $(".tab" + id + "_tuvanvien1_hasCondomWhenAssSex");

			if ($(this).val() > 0) {
				// Clear old data
				checkboxHasCondomWhenAssSex.attr('checked', false);
				$.uniform.update();

				questionHasCondomWhenAssSex.fadeIn();
			} else {
				questionHasCondomWhenAssSex.fadeOut();
			}
		});

	});

	/* End tab 2, 3, 4 */
});