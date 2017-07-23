<div class="widget-box">
	<div class="widget-title title-tuvanvien1"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien1][tentuvanvien]", $user[11]["tuvanvien1"]["tentuvanvien"], ["id" => "tab[1][tuvanvien1][tentuvanvien]", "class" => "span10", "readonly" => ""]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien1][date]", $user[11]["tuvanvien1"]["date"], ["id" => "tab[1][tuvanvien1][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Khách hàng đồng ý ký phiếu đồng ý tham gia trả lời một số câu hỏi riêng tư và đồng ý làm một số xét nghiệm sàng lọc để đánh giá tiêu chuẩn tham gia chương trình (Tư vấn viên giới thiệu
				mẫu phiếu đồng ý tham gia và hướng dẫn khách hàng đánh dấu ô CÓ)</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][accept]", !empty($user[11]["tuvanvien1"]["accept"]) ? $user[11]["tuvanvien1"]["accept"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][accept]", 1, (!empty($user[11]["tuvanvien1"]["accept"]) && $user[11]["tuvanvien1"]["accept"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_accept", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][accept]", 2, (!empty($user[11]["tuvanvien1"]["accept"]) && $user[11]["tuvanvien1"]["accept"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_accept", "disabled" => ""]) !!}
					Không</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Năm sinh</label>
			<div class="controls-custom">
                {!! Form::hidden("tab[1][tuvanvien1][birthyear]", !empty($user[11]["tuvanvien1"]["birthyear"]) ? $user[11]["tuvanvien1"]["birthyear"] : "" ) !!}
                {!! Form::select("tab[1][tuvanvien1][birthyear]", UserHelper::getBirthYearOptions(), $user[11]["tuvanvien1"]["birthyear"], ["id" => "tab[1][tuvanvien1][birthyear]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
            </div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Giới tính</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][sex]", !empty($user[11]["tuvanvien1"]["sex"]) ? $user[11]["tuvanvien1"]["sex"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][sex]", 1, (!empty($user[11]["tuvanvien1"]["sex"]) && $user[11]["tuvanvien1"]["sex"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_sex", "disabled" => ""]) !!}
					Nam</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][sex]", 2, (!empty($user[11]["tuvanvien1"]["sex"]) && $user[11]["tuvanvien1"]["sex"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_sex", "disabled" => ""]) !!}
					Chuyển giới</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Bạn có phải là người Việt Nam không?</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][isVietnamese]", !empty($user[11]["tuvanvien1"]["isVietnamese"]) ? $user[11]["tuvanvien1"]["isVietnamese"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][isVietnamese]", 1, (!empty($user[11]["tuvanvien1"]["isVietnamese"]) && $user[11]["tuvanvien1"]["isVietnamese"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_isVietnamese", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][isVietnamese]", 2, (!empty($user[11]["tuvanvien1"]["isVietnamese"]) && $user[11]["tuvanvien1"]["isVietnamese"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_isVietnamese", "disabled" => ""]) !!}
					Không</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Bạn có bạn tình là người nhiễm HIV không?</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][hasHIVfriend]", !empty($user[11]["tuvanvien1"]["hasHIVfriend"]) ? $user[11]["tuvanvien1"]["hasHIVfriend"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 1, (!empty($user[11]["tuvanvien1"]["hasHIVfriend"]) && $user[11]["tuvanvien1"]["hasHIVfriend"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 2, (!empty($user[11]["tuvanvien1"]["hasHIVfriend"]) && $user[11]["tuvanvien1"]["hasHIVfriend"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 3, (!empty($user[11]["tuvanvien1"]["hasHIVfriend"]) && $user[11]["tuvanvien1"]["hasHIVfriend"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend", "disabled" => ""]) !!}
					Không biết</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 4, (!empty($user[11]["tuvanvien1"]["hasHIVfriend"]) && $user[11]["tuvanvien1"]["hasHIVfriend"] == 4) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend", "disabled" => ""]) !!}
					Không phù hợp</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">6. Bạn có nhận tiền hoặc hiện vật để đổi lấy quan hệ tình dục trong 3 tháng qua:</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][hasSexForCash]", !empty($user[11]["tuvanvien1"]["hasSexForCash"]) ? $user[11]["tuvanvien1"]["hasSexForCash"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasSexForCash]", 1, (!empty($user[11]["tuvanvien1"]["hasSexForCash"]) && $user[11]["tuvanvien1"]["hasSexForCash"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasSexForCash", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasSexForCash]", 2, (!empty($user[11]["tuvanvien1"]["hasSexForCash"]) && $user[11]["tuvanvien1"]["hasSexForCash"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasSexForCash", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasSexForCash]", 3, (!empty($user[11]["tuvanvien1"]["hasSexForCash"]) && $user[11]["tuvanvien1"]["hasSexForCash"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasSexForCash", "disabled" => ""]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">7. Bạn có mắc bệnh lây truyền qua đường tình dục trong 3 tháng qua không?</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Giang mai</label>
				{!! Form::hidden("tab[1][tuvanvien1][hasGiangMaiInLastYear]", !empty($user[11]["tuvanvien1"]["hasGiangMaiInLastYear"]) ? $user[11]["tuvanvien1"]["hasGiangMaiInLastYear"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasGiangMaiInLastYear]", 1, (!empty($user[11]["tuvanvien1"]["hasGiangMaiInLastYear"]) && $user[11]["tuvanvien1"]["hasGiangMaiInLastYear"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasGiangMaiInLastYear", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasGiangMaiInLastYear]", 2, (!empty($user[11]["tuvanvien1"]["hasGiangMaiInLastYear"]) && $user[11]["tuvanvien1"]["hasGiangMaiInLastYear"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasGiangMaiInLastYear", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasGiangMaiInLastYear]", 3, (!empty($user[11]["tuvanvien1"]["hasGiangMaiInLastYear"]) && $user[11]["tuvanvien1"]["hasGiangMaiInLastYear"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasGiangMaiInLastYear", "disabled" => ""]) !!}
					Không trả lời</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Lậu</label>
				{!! Form::hidden("tab[1][tuvanvien1][hasLauInLastYear]", !empty($user[11]["tuvanvien1"]["hasLauInLastYear"]) ? $user[11]["tuvanvien1"]["hasLauInLastYear"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasLauInLastYear]", 1, (!empty($user[11]["tuvanvien1"]["hasLauInLastYear"]) && $user[11]["tuvanvien1"]["hasLauInLastYear"] == 1) ? true : null, ["class" => "tab_1_tuvanvien1_hasLauInLastYear", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasLauInLastYear]", 2, (!empty($user[11]["tuvanvien1"]["hasLauInLastYear"]) && $user[11]["tuvanvien1"]["hasLauInLastYear"] == 2) ? true : null, ["class" => "tab_1_tuvanvien1_hasLauInLastYear", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasLauInLastYear]", 3, (!empty($user[11]["tuvanvien1"]["hasLauInLastYear"]) && $user[11]["tuvanvien1"]["hasLauInLastYear"] == 3) ? true : null, ["class" => "tab_1_tuvanvien1_hasLauInLastYear", "disabled" => ""]) !!}
					Không trả lời</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">c. Chlamydia</label>
				{!! Form::hidden("tab[1][tuvanvien1][hasChlamydiaInLastYear]", !empty($user[11]["tuvanvien1"]["hasChlamydiaInLastYear"]) ? $user[11]["tuvanvien1"]["hasChlamydiaInLastYear"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasChlamydiaInLastYear]", 1, (!empty($user[11]["tuvanvien1"]["hasChlamydiaInLastYear"]) && $user[11]["tuvanvien1"]["hasChlamydiaInLastYear"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasChlamydiaInLastYear", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasChlamydiaInLastYear]", 2, (!empty($user[11]["tuvanvien1"]["hasChlamydiaInLastYear"]) && $user[11]["tuvanvien1"]["hasChlamydiaInLastYear"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasChlamydiaInLastYear", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasChlamydiaInLastYear]", 3, (!empty($user[11]["tuvanvien1"]["hasChlamydiaInLastYear"]) && $user[11]["tuvanvien1"]["hasChlamydiaInLastYear"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasChlamydiaInLastYear", "disabled" => ""]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">8. Các hành vi nguy cơ:</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Bạn có quan hệ tình dục với bao nhiêu bạn tình nam trong vòng 3 tháng qua?</label>
                {!! Form::text("tab[1][tuvanvien1][howManySexFriends]", $user[11]["tuvanvien1"]["howManySexFriends"], ["id" => "tab[1][tuvanvien1][howManySexFriends]", "readonly" => ""]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Trong số đó, bạn quan hệ tình dục đường hậu môn với bao nhiêu người trong 3 tháng qua?</label>
                {!! Form::text("tab[1][tuvanvien1][howManyAssSexFriends]", $user[11]["tuvanvien1"]["howManyAssSexFriends"], ["id" => "tab[1][tuvanvien1][howManyAssSexFriends]", "readonly" => ""]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">c. Bạn có sử dụng bao cao su trong lần quan hệ tình dục gần đây nhất qua đường hậu môn với bạn tình nam không?</label>
                {!! Form::hidden("tab[1][tuvanvien1][hasCondomWhenAssSex]", !empty($user[11]["tuvanvien1"]["hasCondomWhenAssSex"]) ? $user[11]["tuvanvien1"]["hasCondomWhenAssSex"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCondomWhenAssSex]", 1, (!empty($user[11]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[11]["tuvanvien1"]["hasCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasCondomWhenAssSex", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCondomWhenAssSex]", 2, (!empty($user[11]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[11]["tuvanvien1"]["hasCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasCondomWhenAssSex", "disabled" => ""]) !!}
					Không</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">d. Bạn có thường xuyên sử dụng bao cao su khi quan hệ tình dục đường hậu môn với bạn tình nam trong 3 tháng qua không?</label>
                {!! Form::hidden("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", !empty($user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) ? $user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 1, (!empty($user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex", "disabled" => ""]) !!}
					Luôn luôn</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 2, (!empty($user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex", "disabled" => ""]) !!}
					Thỉnh thoảng</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 3, (!empty($user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[11]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex", "disabled" => ""]) !!}
					Không bao giờ</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">9. Bạn có sử dụng ma túy tổng hợp (ví dụ: ma túy đá, Thuốc lắc) trong 12 tháng qua không:</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][hasCocainInLastYear]", !empty($user[11]["tuvanvien1"]["hasCocainInLastYear"]) ? $user[11]["tuvanvien1"]["hasCocainInLastYear"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCocainInLastYear]", 1, (!empty($user[11]["tuvanvien1"]["hasCocainInLastYear"]) && $user[11]["tuvanvien1"]["hasCocainInLastYear"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasCocainInLastYear", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCocainInLastYear]", 2, (!empty($user[11]["tuvanvien1"]["hasCocainInLastYear"]) && $user[11]["tuvanvien1"]["hasCocainInLastYear"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasCocainInLastYear", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCocainInLastYear]", 3, (!empty($user[11]["tuvanvien1"]["hasCocainInLastYear"]) && $user[11]["tuvanvien1"]["hasCocainInLastYear"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasCocainInLastYear", "disabled" => ""]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">10. Bạn có sử dụng ma túy nào khác trong 12 tháng qua không?</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][hasAnotherCocainLastYear]", !empty($user[11]["tuvanvien1"]["hasAnotherCocainLastYear"]) ? $user[11]["tuvanvien1"]["hasAnotherCocainLastYear"] : "" ) !!}
                {!! Form::select("tab[1][tuvanvien1][hasAnotherCocainLastYear]", UserHelper::$optionResult3, $user[11]["tuvanvien1"]["hasAnotherCocainLastYear"], ["id" => "tab[1][tuvanvien1][hasAnotherCocainLastYear]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">11. Bạn có sẵn sàng tự trả tiền thuốc PrEP sau 1 năm sử dụng không?</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][hasPaidForPrEP]", !empty($user[11]["tuvanvien1"]["hasPaidForPrEP"]) ? $user[11]["tuvanvien1"]["hasPaidForPrEP"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasPaidForPrEP]", 1, (!empty($user[11]["tuvanvien1"]["hasPaidForPrEP"]) && $user[11]["tuvanvien1"]["hasPaidForPrEP"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasPaidForPrEP", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasPaidForPrEP]", 2, (!empty($user[11]["tuvanvien1"]["hasPaidForPrEP"]) && $user[11]["tuvanvien1"]["hasPaidForPrEP"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasPaidForPrEP", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasPaidForPrEP]", 3, (!empty($user[11]["tuvanvien1"]["hasPaidForPrEP"]) && $user[11]["tuvanvien1"]["hasPaidForPrEP"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasPaidForPrEP", "disabled" => ""]) !!}
					Chưa biết</label>
			</div>
		</div>

        <div class="control-group">
			<label class="control-label-custom">12. Thu nhập trung bình một tháng của bạn là bao nhiêu: </label>
			<div class="controls-custom">
                {!! Form::hidden("tab[1][tuvanvien1][monthSalary]", !empty($user[11]["tuvanvien1"]["monthSalary"]) ? $user[11]["tuvanvien1"]["monthSalary"] : "" ) !!}
                <label>
                    {!! Form::radio('tab[1][tuvanvien1][monthSalary]', 1, (!empty($user[11]["tuvanvien1"]["monthSalary"]) && $user[11]["tuvanvien1"]["monthSalary"] == 1) ? true : null, ['class' => 'tab1_tuvanvien1_monthSalary', "disabled" => ""]) !!}
					Dưới 5 triệu đồng/tháng</label>
				<label>
                    {!! Form::radio('tab[1][tuvanvien1][monthSalary]', 2, (!empty($user[11]["tuvanvien1"]["monthSalary"]) && $user[11]["tuvanvien1"]["monthSalary"] == 2) ? true : null, ['class' => 'tab1_tuvanvien1_monthSalary', "disabled" => ""]) !!}
					Từ 5 triệu đồng đến dưới 10 triệu đồng/tháng</label>
				<label>
                    {!! Form::radio('tab[1][tuvanvien1][monthSalary]', 3, (!empty($user[11]["tuvanvien1"]["monthSalary"]) && $user[11]["tuvanvien1"]["monthSalary"] == 3) ? true : null, ['class' => 'tab1_tuvanvien1_monthSalary', "disabled" => ""]) !!}
					Từ 10 triệu đồng đến dưới 15 triệu đồng/tháng</label>
                <label>
                    {!! Form::radio('tab[1][tuvanvien1][monthSalary]', 4, (!empty($user[11]["tuvanvien1"]["monthSalary"]) && $user[11]["tuvanvien1"]["monthSalary"] == 4) ? true : null, ['class' => 'tab1_tuvanvien1_monthSalary', "disabled" => ""]) !!}
					Trên 15 triệu đồng/tháng</label>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label-custom">13. Bạn nghe nói về PrEP qua kênh nào?</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien1][howDoYouKnowPrep]", !empty($user[11]["tuvanvien1"]["howDoYouKnowPrep"]) ? $user[11]["tuvanvien1"]["howDoYouKnowPrep"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][howDoYouKnowPrep]", 1, (!empty($user[11]["tuvanvien1"]["howDoYouKnowPrep"]) && $user[11]["tuvanvien1"]["howDoYouKnowPrep"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_howDoYouKnowPrep", "disabled" => ""]) !!}
					Nhân viên xét nghiệm không chuyên</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][howDoYouKnowPrep]", 2, (!empty($user[11]["tuvanvien1"]["howDoYouKnowPrep"]) && $user[11]["tuvanvien1"]["howDoYouKnowPrep"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_howDoYouKnowPrep", "disabled" => ""]) !!}
					Tự đến (có thông tin qua chiến dịch và website của CARMAH)</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][howDoYouKnowPrep]", 3, (!empty($user[11]["tuvanvien1"]["howDoYouKnowPrep"]) && $user[11]["tuvanvien1"]["howDoYouKnowPrep"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_howDoYouKnowPrep", "disabled" => ""]) !!}
					CBO giới thiệu đến</label>
				<label>
					Từ các kênh khác
					{!! Form::text("tab[1][tuvanvien1][howDoYouKnowPrepText]", $user[11]["tuvanvien1"]["howDoYouKnowPrepText"], ["id" => "tab1_tuvanvien1_howDoYouKnowPrepText", "readonly" => ""]) !!}
				</label>
			</div>
		</div>

        <div class="control-group">
			<label class="control-label-custom">14. Đủ tiêu chuẩn hành vi để tiếp tục tham gia đánh giá lâm sàng </label>
			<div class="controls-custom">
                {!! Form::hidden("tab[1][tuvanvien1][checkCondition]", !empty($user[11]["tuvanvien1"]["checkCondition"]) ? $user[11]["tuvanvien1"]["checkCondition"] : "" ) !!}
                <label>
                    {!! Form::radio('tab[1][tuvanvien1][checkCondition]', 1, (!empty($user[11]["tuvanvien1"]["checkCondition"]) && $user[11]["tuvanvien1"]["checkCondition"] == 1) ? true : null, ['class' => 'tab1_tuvanvien1_checkCondition', "disabled" => ""]) !!}
					Đủ tiêu chuẩn, tiếp tục thực hiện các xét nghiệm đánh giá lâm sàng.</label>
				<label>
                    {!! Form::radio('tab[1][tuvanvien1][checkCondition]', 2, (!empty($user[11]["tuvanvien1"]["checkCondition"]) && $user[11]["tuvanvien1"]["checkCondition"] == 2) ? true : null, ['class' => 'tab1_tuvanvien1_checkCondition', "disabled" => ""]) !!}
					Không đủ tiêu chuẩn hành vi, chấm dứt.</label>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label-custom">15. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[1][tuvanvien1][otherComment]", $user[11]["tuvanvien1"]["otherComment"], ["id" => "tab[1][tuvanvien1][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5", "readonly" => ""]) !!}
			</div>
		</div>
	</div>
</div>

<div class="widget-box" id="div-bacsi" style="{{(!empty($user[11]["tuvanvien1"]["checkCondition"]) && $user[11]["tuvanvien1"]["checkCondition"] == 2) ? "display: none;" : "" }}">
	<div class="widget-title title-bacsi"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tên bác sĩ</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][bacsi][tenbacsi]", $user[11]["bacsi"]["tenbacsi"], ["id" => "tab[1][bacsi][tenbacsi]", "class" => "span10", "readonly" => ""]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][bacsi][date]", $user[11]["bacsi"]["date"], ["id" => "tab[1][bacsi][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Bác sĩ form-->
		<div class="control-group">
			<label class="control-label-custom">1. Kết quả xét nghiệm nhanh HIV</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][fastHIVresultdate]", $user[11]["bacsi"]["fastHIVresultdate"], ["id" => "tab[1][bacsi][fastHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][fastHIVresult]", UserHelper::$optionResult2, $user[11]["bacsi"]["fastHIVresult"], ["id" => "tab[1][bacsi][fastHIVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][fastHIVresult]", !empty($user[11]["bacsi"]["fastHIVresult"]) ? $user[11]["bacsi"]["fastHIVresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Kết quả xét nghiệm khẳng định HIV</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][confirmHIVresultdate]", $user[11]["bacsi"]["confirmHIVresultdate"], ["id" => "tab[1][bacsi][confirmHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][confirmHIVresult]", UserHelper::$optionResult, $user[11]["bacsi"]["confirmHIVresult"], ["id" => "tab[1][bacsi][confirmHIVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][confirmHIVresult]", !empty($user[11]["bacsi"]["confirmHIVresult"]) ? $user[11]["bacsi"]["confirmHIVresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Kết quả xét nghiệm HBsAg (Sàng lọc viêm gan B)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][sangLocViemGanBresultdate]", $user[11]["bacsi"]["sangLocViemGanBresultdate"], ["id" => "tab[1][bacsi][sangLocViemGanBresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][sangLocViemGanBresult]", UserHelper::$optionResult, $user[11]["bacsi"]["sangLocViemGanBresult"], ["id" => "tab[1][bacsi][sangLocViemGanBresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][sangLocViemGanBresult]", !empty($user[11]["bacsi"]["sangLocViemGanBresult"]) ? $user[11]["bacsi"]["sangLocViemGanBresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Kết quả xét nghiệm anti-HBs (Kháng thể viêm gan B)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][antiHBsresultdate]", $user[11]["bacsi"]["antiHBsresultdate"], ["id" => "tab[1][bacsi][antiHBsresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][antiHBsresult]", UserHelper::$optionResult, $user[11]["bacsi"]["antiHBsresult"], ["id" => "tab[1][bacsi][antiHBsresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][antiHBsresult]", !empty($user[11]["bacsi"]["antiHBsresult"]) ? $user[11]["bacsi"]["antiHBsresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Kết quả xét nghiệm Anti-HCV (viêm gan C)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][antiHCVresultdate]", $user[11]["bacsi"]["antiHCVresultdate"], ["id" => "tab[1][bacsi][antiHCVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][antiHCVresult]", UserHelper::$optionResult, $user[11]["bacsi"]["antiHCVresult"], ["id" => "tab[1][bacsi][antiHCVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][antiHCVresult]", !empty($user[11]["bacsi"]["antiHCVresult"]) ? $user[11]["bacsi"]["antiHCVresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">6. Kết quả xét nghiệm Anti-HAV (viêm gan A)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][antiHAVresultdate]", $user[11]["bacsi"]["antiHAVresultdate"], ["id" => "tab[1][bacsi][antiHAVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][antiHAVresult]", UserHelper::$optionResult, $user[11]["bacsi"]["antiHAVresult"], ["id" => "tab[1][bacsi][antiHAVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][antiHAVresult]", !empty($user[11]["bacsi"]["antiHAVresult"]) ? $user[11]["bacsi"]["antiHAVresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">7. Kết quả xét nghiệm VDRL/RPR (giang mai)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][giangmaiResultDate]", $user[11]["bacsi"]["giangmaiResultDate"], ["id" => "tab[1][bacsi][giangmaiResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][giangmaiResult]", UserHelper::$optionResult, $user[11]["bacsi"]["giangmaiResult"], ["id" => "tab[1][bacsi][giangmaiResult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][giangmaiResult]", !empty($user[11]["bacsi"]["giangmaiResult"]) ? $user[11]["bacsi"]["giangmaiResult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">8. Chức năng thận (độ thanh thải creatinine > 60ml/min)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][chucnangthanResultDate]", $user[11]["bacsi"]["chucnangthanResultDate"], ["id" => "tab[1][bacsi][chucnangthanResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[1][bacsi][chucnangthanResult]", UserHelper::$optionResult5, $user[11]["bacsi"]["chucnangthanResult"], ["id" => "tab[1][bacsi][chucnangthanResult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[1][bacsi][chucnangthanResult]", !empty($user[11]["bacsi"]["chucnangthanResult"]) ? $user[11]["bacsi"]["chucnangthanResult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">9. Tiền sử bệnh</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[1][bacsi][otherComment]", $user[11]["bacsi"]["otherComment"], ["id" => "tab[1][bacsi][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5", "readonly" => ""]) !!}
			</div>
		</div>

        <div class="control-group">
			<label class="control-label-custom">10. Đủ tiêu chuẩn lâm sàng để tham gia dự án:</label>
			<div class="controls-custom">
                {!! Form::hidden("tab[1][bacsi][checkCondition]", !empty($user[11]["bacsi"]["checkCondition"]) ? $user[11]["bacsi"]["checkCondition"] : "" ) !!}
                <label>
                    {!! Form::radio('tab[1][bacsi][checkCondition]', 1, (!empty($user[11]["bacsi"]["checkCondition"]) && $user[11]["bacsi"]["checkCondition"] == 1) ? true : null, ['class' => 'tab1_bacsi_checkCondition', "disabled" => ""]) !!}
					Đủ tiêu chuẩn lâm sàng, gặp tư vấn viên để ký giấy đồng ý tham gia.</label>
				<label>
                    {!! Form::radio('tab[1][bacsi][checkCondition]', 2, (!empty($user[11]["bacsi"]["checkCondition"]) && $user[11]["bacsi"]["checkCondition"] == 2) ? true : null, ['class' => 'tab1_bacsi_checkCondition', "disabled" => ""]) !!}
					Không đủ tiêu chuẩn lâm sàng, kết thúc.</label>
			</div>
		</div>
	</div>
</div>

<div class="widget-box" id="div-tuvanvien3" style="{{((!empty($user[11]["tuvanvien1"]["checkCondition"]) && $user[11]["tuvanvien1"]["checkCondition"] == 2) || (!empty($user[11]["bacsi"]["checkCondition"]) && $user[11]["bacsi"]["checkCondition"] == 2)) ? "display: none;" : "" }}">
	<div class="widget-title title-tuvanvien3"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien3][tentuvanvien]", $user[11]["tuvanvien3"]["tentuvanvien"], ["id" => "tab[1][tuvanvien3][tentuvanvien]", "class" => "span10", "readonly" => ""]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien3][date]", $user[11]["tuvanvien3"]["date"], ["id" => "tab[1][tuvanvien3][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Bạn có đồng ý tham gia dự án PrEP không? (Tư vấn viên giới thiệu mẫu phiếu đồng ý tham gia và hướng dẫn khách hàng đánh dấu ô CÓ)</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[1][tuvanvien3][accept_prep]", !empty($user[11]["tuvanvien3"]["accept_prep"]) ? $user[11]["tuvanvien3"]["accept_prep"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[1][tuvanvien3][accept_prep]", 1, (!empty($user[11]["tuvanvien3"]["accept_prep"]) && $user[11]["tuvanvien3"]["accept_prep"] == 1) ? true : null, ["class" => "tab1_tuvanvien3_accept_prep", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien3][accept_prep]", 2, (!empty($user[11]["tuvanvien3"]["accept_prep"]) && $user[11]["tuvanvien3"]["accept_prep"] == 2) ? true : null, ["class" => "tab1_tuvanvien3_accept_prep", "disabled" => ""]) !!}
					Không</label>
                <label id="cancelReason" style="{{(empty($user[11]["tuvanvien3"]["accept_prep"]) || $user[11]["tuvanvien3"]["accept_prep"] == 1) ? "display: none;" : "" }}">
					Lý do từ chối tham gia<br/>
					{!! Form::text("tab[1][tuvanvien3][otherReasonText]", !empty($user[11]["tuvanvien3"]["otherReasonText"]) ? $user[11]["tuvanvien3"]["otherReasonText"]:"", ["id" => "tab1_tuvanvien3_otherReasonText", "class" => "span10", "readonly" => ""]) !!}
				</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[1][tuvanvien3][otherComment]", $user[11]["tuvanvien3"]["otherComment"], ["id" => "tab[1][tuvanvien3][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5", "readonly" => ""]) !!}
			</div>
		</div>
	</div>
</div>