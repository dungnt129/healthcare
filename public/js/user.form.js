$(function () {
	/* Tab 1 */
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
	$("#tab1_tuvanvien1_howManySexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab1_tuvanvien1_howManyAssSexFriends").fadeIn();
		} else {
			$("#question_tab1_tuvanvien1_howManyAssSexFriends").fadeOut();
			$("#question_tab1_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	$("#tab1_tuvanvien1_howManyAssSexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab1_tuvanvien1_hasCondomWhenAssSex").fadeIn();
		} else {
			$("#question_tab1_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});
	/* End tab 1 */

	/* Tab 2, 3, 4 */
	$('.tab2_tuvanvien1_hasTieuChay').on('click', function () {

		$('.tab2_tuvanvien1_hasTieuChay').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasTieuChay').on('click', function () {

		$('.tab3_tuvanvien1_hasTieuChay').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasTieuChay').on('click', function () {

		$('.tab4_tuvanvien1_hasTieuChay').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasTired').on('click', function () {

		$('.tab2_tuvanvien1_hasTired').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasTired').on('click', function () {

		$('.tab3_tuvanvien1_hasTired').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasTired').on('click', function () {

		$('.tab4_tuvanvien1_hasTired').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasPoisonGan').on('click', function () {

		$('.tab2_tuvanvien1_hasPoisonGan').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasPoisonGan').on('click', function () {

		$('.tab3_tuvanvien1_hasPoisonGan').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasPoisonGan').on('click', function () {

		$('.tab4_tuvanvien1_hasPoisonGan').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasChangedEmotion').on('click', function () {

		$('.tab2_tuvanvien1_hasChangedEmotion').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasChangedEmotion').on('click', function () {

		$('.tab3_tuvanvien1_hasChangedEmotion').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasChangedEmotion').on('click', function () {

		$('.tab4_tuvanvien1_hasChangedEmotion').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasBuonNon').on('click', function () {

		$('.tab2_tuvanvien1_hasBuonNon').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasBuonNon').on('click', function () {

		$('.tab3_tuvanvien1_hasBuonNon').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasBuonNon').on('click', function () {

		$('.tab4_tuvanvien1_hasBuonNon').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasManNgua').on('click', function () {

		$('.tab2_tuvanvien1_hasManNgua').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasManNgua').on('click', function () {

		$('.tab3_tuvanvien1_hasManNgua').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasManNgua').on('click', function () {

		$('.tab4_tuvanvien1_hasManNgua').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasNonMua').on('click', function () {

		$('.tab2_tuvanvien1_hasNonMua').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasNonMua').on('click', function () {

		$('.tab3_tuvanvien1_hasNonMua').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasNonMua').on('click', function () {

		$('.tab4_tuvanvien1_hasNonMua').not(this).attr('checked', false);

		$.uniform.update();
	});


	$('.tab2_tuvanvien1_hasCondomWhenAssSex').on('click', function () {

		$('.tab2_tuvanvien1_hasCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasCondomWhenAssSex').on('click', function () {

		$('.tab3_tuvanvien1_hasCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasCondomWhenAssSex').on('click', function () {

		$('.tab4_tuvanvien1_hasCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasAlwaysUseCondomWhenAssSex').on('click', function () {

		$('.tab2_tuvanvien1_hasAlwaysUseCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasAlwaysUseCondomWhenAssSex').on('click', function () {

		$('.tab3_tuvanvien1_hasAlwaysUseCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasAlwaysUseCondomWhenAssSex').on('click', function () {

		$('.tab4_tuvanvien1_hasAlwaysUseCondomWhenAssSex').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien1_hasCocainInLastYear').on('click', function () {

		$('.tab2_tuvanvien1_hasCocainInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien1_hasCocainInLastYear').on('click', function () {

		$('.tab3_tuvanvien1_hasCocainInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien1_hasCocainInLastYear').on('click', function () {

		$('.tab4_tuvanvien1_hasCocainInLastYear').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien3_hasHIV').on('click', function () {

		$('.tab2_tuvanvien3_hasHIV').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab3_tuvanvien3_hasHIV').on('click', function () {

		$('.tab3_tuvanvien3_hasHIV').not(this).attr('checked', false);

		$.uniform.update();
	});
	$('.tab4_tuvanvien3_hasHIV').on('click', function () {

		$('.tab4_tuvanvien3_hasHIV').not(this).attr('checked', false);

		$.uniform.update();
	});

	$('.tab2_tuvanvien3_otherReason').on('click', function () {

		$('.tab2_tuvanvien3_otherReason').not(this).attr('checked', false);

		$('#tab2_tuvanvien3_otherReasonText').val("");

		$.uniform.update();
	});
	$('#tab2_tuvanvien3_otherReasonText').on('change', function () {
		$('.tab2_tuvanvien3_otherReason').attr('checked', false);
		$.uniform.update();
	});


	$('.tab3_tuvanvien3_otherReason').on('click', function () {

		$('.tab3_tuvanvien3_otherReason').not(this).attr('checked', false);

		$('#tab3_tuvanvien3_otherReasonText').val("");

		$.uniform.update();
	});
	$('#tab3_tuvanvien3_otherReasonText').on('change', function () {
		$('.tab3_tuvanvien3_otherReason').attr('checked', false);
		$.uniform.update();
	});

	$('.tab4_tuvanvien3_otherReason').on('click', function () {

		$('.tab4_tuvanvien3_otherReason').not(this).attr('checked', false);

		$('#tab4_tuvanvien3_otherReasonText').val("");

		$.uniform.update();
	});
	$('#tab4_tuvanvien3_otherReasonText').on('change', function () {
		$('.tab4_tuvanvien3_otherReason').attr('checked', false);
		$.uniform.update();
	});

	// Toggle sub question
	$("#tab2_tuvanvien1_howManySexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab2_tuvanvien1_howManyAssSexFriends").fadeIn();
		} else {
			$("#question_tab2_tuvanvien1_howManyAssSexFriends").fadeOut();
			$("#question_tab2_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	$("#tab2_tuvanvien1_howManyAssSexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab2_tuvanvien1_hasCondomWhenAssSex").fadeIn();
		} else {
			$("#question_tab2_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	$("#tab3_tuvanvien1_howManySexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab3_tuvanvien1_howManyAssSexFriends").fadeIn();
		} else {
			$("#question_tab3_tuvanvien1_howManyAssSexFriends").fadeOut();
			$("#question_tab3_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	$("#tab3_tuvanvien1_howManyAssSexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab3_tuvanvien1_hasCondomWhenAssSex").fadeIn();
		} else {
			$("#question_tab3_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	$("#tab4_tuvanvien1_howManySexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab4_tuvanvien1_howManyAssSexFriends").fadeIn();
		} else {
			$("#question_tab4_tuvanvien1_howManyAssSexFriends").fadeOut();
			$("#question_tab4_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	$("#tab4_tuvanvien1_howManyAssSexFriends").on('change', function () {
		if ($(this).val() > 0) {
			$("#question_tab4_tuvanvien1_hasCondomWhenAssSex").fadeIn();
		} else {
			$("#question_tab4_tuvanvien1_hasCondomWhenAssSex").fadeOut();
		}
	});

	/* End tab 2, 3, 4 */
});