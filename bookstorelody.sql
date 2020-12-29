-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 03, 2020 lúc 07:20 AM
-- Phiên bản máy phục vụ: 5.7.26
-- Phiên bản PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstorelody`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `taikhoan` varchar(10) NOT NULL,
  `matkhau` varchar(10) NOT NULL,
  `quyen` int(2) NOT NULL,
  `hoten` varchar(30) NOT NULL,
  `dienthoai` varchar(15) NOT NULL,
  PRIMARY KEY (`taikhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`taikhoan`, `matkhau`, `quyen`, `hoten`, `dienthoai`) VALUES
('admin1', '123', 1, 'Nguyễn văn a', '12121212'),
('admin2', '123', 2, 'Nguyễn văn b', '23232323');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `mabanner` varchar(10) NOT NULL,
  `tenbanner` varchar(50) NOT NULL,
  `hinh` varchar(10) NOT NULL,
  PRIMARY KEY (`mabanner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

DROP TABLE IF EXISTS `binhluan`;
CREATE TABLE IF NOT EXISTS `binhluan` (
  `taikhoankhachhang` varchar(30) NOT NULL,
  `masacch` varchar(10) NOT NULL,
  `noidung` text NOT NULL,
  KEY `binhluan_fkkhachhang` (`taikhoankhachhang`),
  KEY `binhluan_fksach` (`masacch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `madonhang` int(10) NOT NULL,
  `masach` varchar(10) NOT NULL,
  `soluong` int(10) NOT NULL,
  `dongia` int(10) NOT NULL,
  KEY `ctdonhang_fksach` (`masach`),
  KEY `ctdonhang_fkdonhang` (`madonhang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`madonhang`, `masach`, `soluong`, `dongia`) VALUES
(1, 'kd03', 1, 350000),
(1, 'kd01', 1, 300000),
(1, 'kd02', 1, 300000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkhuyenmai`
--

DROP TABLE IF EXISTS `chitietkhuyenmai`;
CREATE TABLE IF NOT EXISTS `chitietkhuyenmai` (
  `masach` varchar(10) NOT NULL,
  `makhyenmai` varchar(10) NOT NULL,
  KEY `ctkhuyenmai_fkkhuyenmai` (`makhyenmai`),
  KEY `ctctkhuyenmai_fksach` (`masach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `madonhang` int(10) NOT NULL AUTO_INCREMENT,
  `taikhoankhachhang` varchar(30) NOT NULL,
  `taikhoanadmin` varchar(10) DEFAULT NULL,
  `ngaydathang` date NOT NULL,
  `trangthai` int(10) NOT NULL,
  `thanhtien` int(20) NOT NULL,
  PRIMARY KEY (`madonhang`),
  KEY `donhang_fkkhachhang` (`taikhoankhachhang`),
  KEY `donhang_fkadmin` (`taikhoanadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`madonhang`, `taikhoankhachhang`, `taikhoanadmin`, `ngaydathang`, `trangthai`, `thanhtien`) VALUES
(1, 'chi@yahoo.com', NULL, '2020-12-03', 1, 950000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `taikhoan` varchar(30) NOT NULL,
  `matkhau` varchar(30) NOT NULL,
  `hoten` varchar(30) NOT NULL,
  `sodienthoai` varchar(15) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  PRIMARY KEY (`taikhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`taikhoan`, `matkhau`, `hoten`, `sodienthoai`, `diachi`) VALUES
('chi@yahoo.com', '123', 'đặng hiển chí', '11111111', 'abc123'),
('tri@yahoo.com', '123', 'đặng hiển trí', '2222222', 'xyz123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `makhuyenmai` varchar(10) NOT NULL,
  `tenkhuyenmai` text NOT NULL,
  `taikhoanadmin` varchar(10) NOT NULL,
  PRIMARY KEY (`makhuyenmai`),
  KEY `khuyenmai_fkadmin` (`taikhoanadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

DROP TABLE IF EXISTS `loai`;
CREATE TABLE IF NOT EXISTS `loai` (
  `maloai` varchar(10) NOT NULL,
  `tenloai` varchar(50) NOT NULL,
  PRIMARY KEY (`maloai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`maloai`, `tenloai`) VALUES
('kd', 'Kinh dị'),
('lm', 'Lãng mạn'),
('tt', 'Trinh thám');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

DROP TABLE IF EXISTS `sach`;
CREATE TABLE IF NOT EXISTS `sach` (
  `masach` varchar(10) NOT NULL,
  `tensach` varchar(100) NOT NULL,
  `mota` text NOT NULL,
  `gia` int(10) NOT NULL,
  `hinh` varchar(100) NOT NULL,
  `maloai` varchar(10) NOT NULL,
  `matacgia` varchar(10) NOT NULL,
  `luotmua` int(10) NOT NULL,
  PRIMARY KEY (`masach`),
  KEY `sach_fkloai` (`maloai`),
  KEY `sach_fktacgia` (`matacgia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`masach`, `tensach`, `mota`, `gia`, `hinh`, `maloai`, `matacgia`, `luotmua`) VALUES
('abc', 'abc', 'abc', 100000, 'kd01.jpg', 'kd', 'tg01', 0),
('kd01', 'The Haunting of Hill House', 'Câu chuyện về bốn nhân vật thích khám phá tại một tòa nhà nổi tiếng không thân thiện với cái tên Hill House (ngôi nhà trên đồi) gồm: Tiến sĩ Montague, một học giả nghiên cứu những vấn đề huyền bí đi tìm bằng chứng về một “bóng ma”; Theodora, viên trợ lý hoạt bát của ông; Eleanor, một phụ nữ trẻ mảnh mai thường trò chuyện cùng yêu tinh và Luke, người thừa kế tương lai của Hill House.', 300000, 'kd01', 'kd', 'tg08', 0),
('kd02', 'The Exorcist', 'Câu chuyện tập trung vào Regan, cô con gái 11 tuổi của một nữ diễn viên sống tại Washington, DC. Cô bé bị một con quỷ từ thời cổ đại chiếm hữu thân xác và có nhiều hành vi kỳ lạ. Sau nhiều cuộc điều trị tâm lý không thành, mẹ cô đã buộc phải nhờ đến sự can thiệp của một linh mục, Cha Damien Karras. Cùng với sự giúp sức của một vị linh mục khác là Cha Lankester Merrin, Karras làm lễ trừ tà cho Regan nhưng không thành công. Merrin qua đời trong khi đang tiến hành nghi lễ vì một cơn đau tim còn Karras trong nỗ lực van xin con quỷ tha cho Regan và chiếm lấy thân xác mình sau đó đã nhảy qua cửa sổ tự kết liễu đời mình cùng con ác quỷ.', 300000, 'kd02', 'kd', 'tg09', 0),
('kd03', 'The Woman in Black', 'The Woman in Black (1983) của Susan Hill là một cuốn tiểu thuyết kinh dị được viết theo phong cách truyền thống của một cuốn tiểu thuyết Gothic. Lấy bối cảnh là những cánh đồng hoang vu của nước Anh, trên một con đường đắp cao bị cô lập, nhân vật chính của câu truyện là Arthur Kipps, một luật sư trẻ đến từ phía bắc London để tham dự tang lễ và giải quyết các công việc của bà Alice Drablow nhà Eel Marsh.', 350000, 'kd03', 'kd', 'tg10', 0),
('lm01', 'Tiếng chim hót trong bụi mận gai', 'Nhân vật trung tâm trong tác phẩm chính là Meggie – người phụ nữ cố gắng vượt lên số phận, vượt mặt Chúa trời để giành lấy tình yêu, giành lấy hạnh phúc. Chuyện tình của cô với cha Ralph được ví như bài ca của chú chim hót hay nhất thế gian, cả hai đều phải đánh đổi cả cuộc đời để có được điều mình muốn. “Bởi vì tất cả những gì tốt đẹp nhất chỉ có thể có được khi ta chịu trả giá bằng nỗi đau khổ vĩ đại”.', 200000, 'lm01', 'lm', 'tg02', 0),
('lm02', 'Anna Karenina', 'Câu chuyện hư cấu bắt đầu khi Oliver, một giảng viên 24 tuổi ở Columbia (Mỹ) đến dinh thự của nhà cậu Elio tại Ý trong 6 tuần để sửa lại bản thảo cho cuốn tiểu thuyết sắp xuất bản của mình. Mối tình lãng mạn nhưng đầy khắc khoải giữa con trai chủ nhà - chàng thiếu niên 17 tuổi, nhạy cảm, yêu âm nhạc Elio với vị khách trọ, hơn cậu tới 7 tuổi, Oliver dần nảy nở giữa khung cảnh mùa hè nước Ý tràn ngập ánh nắng ấm áp, cổ kính và rất đỗi nên thơ với hồ nước trong xanh, thảm cỏ rộng lớn, hay khu vườn đầy trái đào, mơ chín ửng và những triền đồi ngập hướng dương.', 150000, 'lm02', 'lm', 'tg03', 8),
('lm03', 'Outlander 1 - tập 1', 'Outlander - Vòng Tròn Đá Thiêng 1 là cuốn đầu tiên trong bộ tiểu thuyết lịch sử xuyên thời gian của Diana Gabaldon. Bà đã dệt nên một câu chuyện đầy ma lực đan xen giữa lịch sử và thần thoại, nó chứa đầy những đam mê mãnh liệt và sự táo bạo. Năm 1945, sau khi Chiến tranh thế giới thứ II kết thúc, Claire - một nữ y tá quân đội - vừa được trở về đoàn tụ cùng chồng là Frank Randall sau tám năm xa cách vì chiến tranh. Họ quyết định hưởng tuần trăng mật thứ hai tại vùng cao nguyên Scotland huyền bí. Một lần tình cờ, Claire dạo chơi lên ngọn đồi tiên nơi có vòng tròn đá cổ xưa và bị kéo về quá khứ tới năm 1743. Ở đó, cô bị các phe phái nghi ngờ là gián điệp, bị mắc kẹt trong những âm mưu ngấm ngầm và cuộc chiến giữa các lãnh chúa vùng cao nguyên với quân Anh. Claire bị ép buộc kết hôn với một chiến binh trẻ người Scot để có được sự bảo vệ và an toàn. Claire bị giằng xé giữa hai cuộc hôn nhân, giữa lòng chungthủy và những khao khát đam mê, giữa hai người đàn ông khác xa nhau về mọi mặt trong hai cuộc đời không thể dung hòa…', 250000, 'lm03', 'lm', 'tg04', 4),
('lm04', 'Outlander 1 - tập 2', 'Outlander - Vòng Tròn Đá Thiêng 1 là cuốn đầu tiên trong bộ tiểu thuyết lịch sử xuyên thời gian của Diana Gabaldon. Bà đã dệt nên một câu chuyện đầy ma lực đan xen giữa lịch sử và thần thoại, nó chứa đầy những đam mê mãnh liệt và sự táo bạo. Năm 1945, sau khi Chiến tranh thế giới thứ II kết thúc, Claire - một nữ y tá quân đội - vừa được trở về đoàn tụ cùng chồng là Frank Randall sau tám năm xa cách vì chiến tranh. Họ quyết định hưởng tuần trăng mật thứ hai tại vùng cao nguyên Scotland huyền bí. Một lần tình cờ, Claire dạo chơi lên ngọn đồi tiên nơi có vòng tròn đá cổ xưa và bị kéo về quá khứ tới năm 1743. Ở đó, cô bị các phe phái nghi ngờ là gián điệp, bị mắc kẹt trong những âm mưu ngấm ngầm và cuộc chiến giữa các lãnh chúa vùng cao nguyên với quân Anh. Claire bị ép buộc kết hôn với một chiến binh trẻ người Scot để có được sự bảo vệ và an toàn. Claire bị giằng xé giữa hai cuộc hôn nhân, giữa lòng chungthủy và những khao khát đam mê, giữa hai người đàn ông khác xa nhau về mọi mặt trong hai cuộc đời không thể dung hòa…', 250000, 'lm04', 'lm', 'tg04', 5),
('lm05', 'Outlander 2 - tập 1', 'Outlander - Chuồn Chuồn Hổ Phách là cuốn thứ hai trong bộ tiểu thuyết lịch sử xuyên thời gian của Diana Gabaldon. Bà đã dệt nên một câu chuyện đầy ma lực đan xen giữa lịch sử và thần thoại, nó chứa đầy những đam mê mãnh liệt và sự táo bạo. Vô tình bị kéo về quá khứ, Claire - một nữ y tá quân đội người Anh - đã gặp gỡ và kết duyên với Jamie, một chàng chiến binh trẻ người Scot dũng mãnh, hào sảng. Sau nhiều biến cố, họ buộc phải rời nước Anh để sang Pháp. Tại đây, khi biết cuộc nổi dậy của phái Jacobite bắt đầu nhen nhóm, Jamie và Claire quyết định tìm mọi cách để ngăn chặn trận chiến Culloden đẫm máu xảy ra, nhằm bảo vệ sinh mạng của hàng nghìn người Scot vô tội. Thế nhưng thay đổi lịch sử có phải là chuyện dễ dàng? Liệu họ có thể cải biến vận mệnh của cả một dân tộc hay đành chịu cúi đầu khuất phục trước bàn tay tàn nhẫn của số phận?', 250000, 'lm05', 'lm', 'tg04', 4),
('lm06', 'Outlander 2 - tập 2', 'Outlander - Chuồn Chuồn Hổ Phách là cuốn thứ hai trong bộ tiểu thuyết lịch sử xuyên thời gian của Diana Gabaldon. Bà đã dệt nên một câu chuyện đầy ma lực đan xen giữa lịch sử và thần thoại, nó chứa đầy những đam mê mãnh liệt và sự táo bạo. Vô tình bị kéo về quá khứ, Claire - một nữ y tá quân đội người Anh - đã gặp gỡ và kết duyên với Jamie, một chàng chiến binh trẻ người Scot dũng mãnh, hào sảng. Sau nhiều biến cố, họ buộc phải rời nước Anh để sang Pháp. Tại đây, khi biết cuộc nổi dậy của phái Jacobite bắt đầu nhen nhóm, Jamie và Claire quyết định tìm mọi cách để ngăn chặn trận chiến Culloden đẫm máu xảy ra, nhằm bảo vệ sinh mạng của hàng nghìn người Scot vô tội. Thế nhưng thay đổi lịch sử có phải là chuyện dễ dàng? Liệu họ có thể cải biến vận mệnh của cả một dân tộc hay đành chịu cúi đầu khuất phục trước bàn tay tàn nhẫn của số phận?', 250000, 'lm06', 'lm', 'tg04', 5),
('tt01', 'Sherlock Holmes 1', '“Tên tôi là Sherlock Holmes. Công việc của tôi là tìm hiểu những gì mà người khác không biết…”\r\n\r\nĐối với các độc giả yêu thích dòng văn trinh thám nói riêng cũng như những người yêu sách trên toàn thế giới nói chung thì không phải nói nhiều về sức hút của hai cái tên: nhà văn Conan Doyle và “đứa con tinh thần” của cả cuộc đời ông - Sherlock Holmes.\r\n\r\nNhân vật Sherlock Holmes từ lâu đã trở thành nguồn cảm hứng cho hàng trăm, hàng ngàn tác phẩm ở nhiều loại hình nghệ thuật khác: từ âm nhạc, ca kịch đến điện ảnh… Bộ sách Sherlock Holmes toàn tập (Hộp 3 Tập) một lần nữa mang đến cho người đọc cơ hội được nhìn ngắm, ngưỡng mộ và đánh giá nhân vật độc đáo của nhà văn tài năng Conan Doyle. Chân dung cuộc đời, sự nghiệp và nhân cách của Sherlock Holmes chưa bao giờ được tái hiện chân thực, đầy đủ và sống động đến thế...Chỉ từ một giọt nước, người giỏi suy luận có thể đoán ra rất nhiều chuyện liên quan đến một thác nước hay một đại dương dù họ chưa bao giờ tận mắt nhìn thấy chúng.Như vậy, cuộc sống là một chuỗi mắt xích rộng lớn nhất của nó, nếu ta biết được một mắt xích. Như tất cả mọi khoa học khác, “suy đoán và phân tích” là một khoa học mà ta chỉ có thể làm chủ nó sau một quá trình nghiên cứu dài lâu, bền bỉ.', 100000, 'tt01', 'tt', 'tg01', 5),
('tt02', 'Sherlock Holmes 2', '“Tên tôi là Sherlock Holmes. Công việc của tôi là tìm hiểu những gì mà người khác không biết…”\r\n\r\nĐối với các độc giả yêu thích dòng văn trinh thám nói riêng cũng như những người yêu sách trên toàn thế giới nói chung thì không phải nói nhiều về sức hút của hai cái tên: nhà văn Conan Doyle và “đứa con tinh thần” của cả cuộc đời ông - Sherlock Holmes.\r\n\r\nNhân vật Sherlock Holmes từ lâu đã trở thành nguồn cảm hứng cho hàng trăm, hàng ngàn tác phẩm ở nhiều loại hình nghệ thuật khác: từ âm nhạc, ca kịch đến điện ảnh… Bộ sách Sherlock Holmes toàn tập (Hộp 3 Tập) một lần nữa mang đến cho người đọc cơ hội được nhìn ngắm, ngưỡng mộ và đánh giá nhân vật độc đáo của nhà văn tài năng Conan Doyle. Chân dung cuộc đời, sự nghiệp và nhân cách của Sherlock Holmes chưa bao giờ được tái hiện chân thực, đầy đủ và sống động đến thế... Chỉ từ một giọt nước, người giỏi suy luận có thể đoán ra rất nhiều chuyện liên quan đến một thác nước hay một đại dương dù họ chưa bao giờ tận mắt nhìn thấy chúng. Như vậy, cuộc sống là một chuỗi mắt xích rộng lớn nhất của nó, nếu ta biết được một mắt xích. Như tất cả mọi khoa học khác, “suy đoán và phân tích” là một khoa học mà ta chỉ có thể làm chủ nó sau một quá trình nghiên cứu dài lâu, bền bỉ', 100000, 'tt02', 'tt', 'tg01', 7),
('tt03', 'Sherlock Holmes 3', '“Tên tôi là Sherlock Holmes. Công việc của tôi là tìm hiểu những gì mà người khác không biết…”\r\n\r\nĐối với các độc giả yêu thích dòng văn trinh thám nói riêng cũng như những người yêu sách trên toàn thế giới nói chung thì không phải nói nhiều về sức hút của hai cái tên: nhà văn Conan Doyle và “đứa con tinh thần” của cả cuộc đời ông - Sherlock Holmes.\r\n\r\nNhân vật Sherlock Holmes từ lâu đã trở thành nguồn cảm hứng cho hàng trăm, hàng ngàn tác phẩm ở nhiều loại hình nghệ thuật khác: từ âm nhạc, ca kịch đến điện ảnh… Bộ sách Sherlock Holmes toàn tập (Hộp 3 Tập) một lần nữa mang đến cho người đọc cơ hội được nhìn ngắm, ngưỡng mộ và đánh giá nhân vật độc đáo của nhà văn tài năng Conan Doyle. Chân dung cuộc đời, sự nghiệp và nhân cách của Sherlock Holmes chưa bao giờ được tái hiện chân thực, đầy đủ và sống động đến thế... Chỉ từ một giọt nước, người giỏi suy luận có thể đoán ra rất nhiều chuyện liên quan đến một thác nước hay một đại dương dù họ chưa bao giờ tận mắt nhìn thấy chúng. Như vậy, cuộc sống là một chuỗi mắt xích rộng lớn nhất của nó, nếu ta biết được một mắt xích. Như tất cả mọi khoa học khác, “suy đoán và phân tích” là một khoa học mà ta chỉ có thể làm chủ nó sau một quá trình nghiên cứu dài lâu, bền bỉ.', 100000, 'tt03', 'tt', 'tg01', 4),
('tt04', 'Thú tội', 'Đây là một trong những cuốn sách mà câu chuyện của nó khiến  người đọc phải ớn lạnh bởi sự tàn ác của hung thủ và của chính nạn nhân, từ động cơ gây án cũng như cách thức giết người của hung thủ và cả sự trả thù đến từ nạn nhân. Tác phẩm kể về diễn biến tâm lý của những nhân vật, cụ thể là những đứa trẻ mới lớn bị giáo dục một cách lầm lạc. Như cái tên của cuốn sách, 6 chương vẻn vẹn hơn 200 trang sách chỉ nói về thú tội. Lần lượt là tường thuật của cô giáo, lớp trưởng, bà mẹ học sinh B, rồi đến lời tự sự điên loạn của B, di chúc của A & cuối cùng khép lại bằng cuộc gọi của cô giáo cho học sinh A. Tất cả mọi lời thú tội đều bắt đầu xung quanh câu chuyện về Manami, con gái của cô giáo, bị giết hại bởi chính những học sinh của mình.\r\n\r\n', 200000, 'tt04', 'tt', 'tg05', 1),
('tt05', 'Phía sau Nghi can X', 'Togashi đột ngột xuất hiện sau 5 năm li dị đã thay đổi cuộc đời Yasuki hoàn toàn, gã đeo bám chị không dứt, buổi tối định mệnh đó sau một hồi giằng co chị vô tình giết Togashi. Ishigami, một thiên tài toán học ẩn dật bất ngờ xuất hiện, đề nghị giúp chị phi tang cái xác. Kế tiếp là chuỗi điều tra của hai điều tra viên Kusanagi, Kisuya và nhà vật lý Yugawa. Tác phẩm đi theo một hướng hoàn toàn khác so với các tác phẩm trinh thám thông thường, đó là không chú trọng vào việc tìm ra hung thủ mà chú trọng vào cách thức tạo bằng chứng ngoại phạm.', 150000, 'tt05', 'tt', 'tg06', 0),
('tt06', 'Sự im lặng của bầy cừu', 'Sự im lặng của bầy cừu là câu chuyện đầy gay cấn và hấp dẫn kể về hàng loạt vụ án giết người xảy ra nhưng không để lại bất kỳ một dấu vết gì. Tuy nhiên có một bác sĩ tâm lý bị tâm thần có tên là Lecter lại rõ về hành vi của kẻ sát nhân nhưng không hiểu sao ông chỉ im lặng. Cuối cùng thì sự thật cũng đã phơi bày,  thủ phạm của hàng loạt vụ án giết người là một tên có nhân cách bệnh hoạn, một kẻ tâm thần vô cùng nguy hiểm.…', 250000, 'tt06', 'tt', 'tg07', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacgia`
--

DROP TABLE IF EXISTS `tacgia`;
CREATE TABLE IF NOT EXISTS `tacgia` (
  `matacgia` varchar(10) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  PRIMARY KEY (`matacgia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tacgia`
--

INSERT INTO `tacgia` (`matacgia`, `hoten`) VALUES
('tg01', 'Athur Conan Doyle'),
('tg02', 'Colleen McCullough'),
('tg03', 'Leo Tolstoy'),
('tg04', 'Diana Gabbaldon'),
('tg05', 'Kanae Minato'),
('tg06', 'Higashino Keigo'),
('tg07', 'Thomas Harris'),
('tg08', 'Shirley Jackson'),
('tg09', 'William Peter Blatty'),
('tg10', 'Susan Hill'),
('tg11', 'abc'),
('tg12', 'chi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

DROP TABLE IF EXISTS `tintuc`;
CREATE TABLE IF NOT EXISTS `tintuc` (
  `matintuc` varchar(10) NOT NULL,
  `tentictuc` varchar(50) NOT NULL,
  `taikhoanadmin` varchar(10) NOT NULL,
  PRIMARY KEY (`matintuc`),
  KEY `tintuc_fkadmin` (`taikhoanadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_fkkhachhang` FOREIGN KEY (`taikhoankhachhang`) REFERENCES `khachhang` (`taikhoan`),
  ADD CONSTRAINT `binhluan_fksach` FOREIGN KEY (`masacch`) REFERENCES `sach` (`masach`);

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `ctdonhang_fkdonhang` FOREIGN KEY (`madonhang`) REFERENCES `donhang` (`madonhang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctdonhang_fksach` FOREIGN KEY (`masach`) REFERENCES `sach` (`masach`);

--
-- Các ràng buộc cho bảng `chitietkhuyenmai`
--
ALTER TABLE `chitietkhuyenmai`
  ADD CONSTRAINT `ctctkhuyenmai_fksach` FOREIGN KEY (`masach`) REFERENCES `sach` (`masach`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctkhuyenmai_fkkhuyenmai` FOREIGN KEY (`makhyenmai`) REFERENCES `khuyenmai` (`makhuyenmai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_fkadmin` FOREIGN KEY (`taikhoanadmin`) REFERENCES `admin` (`taikhoan`),
  ADD CONSTRAINT `donhang_fkkhachhang` FOREIGN KEY (`taikhoankhachhang`) REFERENCES `khachhang` (`taikhoan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `khuyenmai_fkadmin` FOREIGN KEY (`taikhoanadmin`) REFERENCES `admin` (`taikhoan`);

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_fkloai` FOREIGN KEY (`maloai`) REFERENCES `loai` (`maloai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sach_fktacgia` FOREIGN KEY (`matacgia`) REFERENCES `tacgia` (`matacgia`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD CONSTRAINT `tintuc_fkadmin` FOREIGN KEY (`taikhoanadmin`) REFERENCES `admin` (`taikhoan`),
  ADD CONSTRAINT `tintuc_fkbanner` FOREIGN KEY (`matintuc`) REFERENCES `banner` (`mabanner`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
