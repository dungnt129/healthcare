Tư vấn viên: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "tentuvanvien") ?> - Ngày: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "date") ?>

1. Khách hàng đồng ý ký phiếu đồng ý tham gia trả lời một số câu hỏi riêng tư và đồng ý làm một số xét nghiệm sàng lọc để đánh giá tiêu chuẩn tham gia chương trình (Tư vấn viên giới thiệu mẫu phiếu đồng ý tham gia và hướng dẫn khách hàng đánh dấu ô CÓ): <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "accept") ?>
2. Năm sinh: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "birthyear") ?>
3. Giới tính: <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "sex") ?>
4. Bạn có phải là người Việt Nam không? <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "isVietnamese") ?>
5. Bạn có bạn tình là người nhiễm HIV không? <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasHIVfriend") ?>
6. Bạn có nhận tiền hoặc hiện vật để đổi lấy quan hệ tình dục trong năm qua ? <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasSexForCash") ?>
7. Bạn có mắc bệnh lây truyền qua đường tình dục trong năm qua không?
	a. Giang mai: <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasGiangMaiInLastYear") ?>
	b. Lậu: <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasLauInLastYear") ?>
	c. Chlamydia: <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasChlamydiaInLastYear") ?>
8. Các hành vi nguy cơ:
	a. Câu hỏi 1: Bạn có quan hệ tình dục với bao nhiêu bạn tình nam trong vòng 3 tháng qua? <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "howManySexFriends") ?>
	@if(!empty($data["tuvanvien1"]["howManySexFriends"]))
	b. Câu hỏi 2: Trong số đó, bạn quan hệ tình dục đường hậu môn hay âm đạo giả với bao nhiêu người trong 3 tháng qua? <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "howManyAssSexFriends") ?>
	@endif
	@if(!empty($data["tuvanvien1"]["howManyAssSexFriends"]))
	c. Câu hỏi 3: Bạn có sử dụng bao cao su trong lần quan hệ tình dục gần đây nhất qua đường hậu môn hay âm đạo giả với bạn tình nam không? <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasCondomWhenAssSex") ?>
	@endif
	d. Bạn có thường xuyên sử dụng bao cao su khi quan hệ tình dục đường hậu môn hay âm đạo giả với bạn tình nam trong 3 tháng qua không? <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex") ?>
9. Bạn có sử dụng ma túy tổng hợp (ma túy đá, Speed, Thuốc lắc) trong năm qua không: <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasCocainInLastYear") ?>
10. Bạn có sử dụng ma túy nào khác trong năm qua không? <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasAnotherCocainLastYear") ?>
11. Bạn có sẵn sàng tự trả tiền thuốc PrEP sau 1 năm sử dụng không? <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "hasPaidForPrEP") ?>
12. Chúng tôi có thể liên lạc với bạn như thế nào?
	a. Email: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "email") ?>
	b. Số di động: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "mobile") ?>
13. Bạn nghe nói về PrEP qua kênh nào?
@if(!empty($data["tuvanvien1"]["howDoYouKnowPrepText"])) <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "howDoYouKnowPrepText")?> @else <?php echo UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "howDoYouKnowPrep") ?>  @endif
14. Các nhận xét khác:
<?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien1", "otherComment") ?>

---------------------------------------------------------------
Tên bác sĩ: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "tenbacsi") ?> - Ngày: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "date") ?>

1. Kết quả xét nghiệm nhanh HIV: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "fastHIVresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "fastHIVresultdate") ?>
2. Kết quả xét nghiệm khẳng định HIV: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "confirmHIVresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "confirmHIVresultdate") ?>
3. Kết quả xét nghiệm Viêm gan B & C: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "viemGanBresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "viemGanBresultdate") ?>
4. Kết quả xét nghiệm HBsAg (Sàng lọc viêm gan B): <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "sangLocViemGanBresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "sangLocViemGanBresultdate") ?>
5. Kết quả xét nghiệm anti-HBs (Kháng thể viêm gan B): <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "antiHBsresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "antiHBsresultdate") ?>
6. Kết quả xét nghiệm Anti-HCV (viêm gan C): <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "antiHCVresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "antiHCVresultdate") ?>
7. Kết quả xét nghiệm Anti-HAV (viêm gan A): <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "antiHAVresult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "antiHAVresultdate") ?>
8. Kết quả xét nghiệm VDRL/RPR (giang mai): <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "giangmaiResult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "giangmaiResultDate") ?>
9. Chức năng thận (độ thanh thải creatinine > 60ml/min): <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "chucnangthanResult") ?> - Ngày xét nghiệm: <?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "chucnangthanResultDate") ?>
10. Các nhận xét khác:
<?php echo  UserHelper::getDisplayTextDataDay1($data, "bacsi", "otherComment") ?>

---------------------------------------------------------------
Tư vấn viên: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien3", "tentuvanvien") ?> - Ngày: <?php echo  UserHelper::getDisplayTextDataDay1($data, "tuvanvien3", "date") ?>

