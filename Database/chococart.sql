-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 09:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chococart`
-- Developed By: Aniket Kumar Jha
--

-- --------------------------------------------------------

--
-- Table structure for table `cc_admin`
--

CREATE TABLE `cc_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_admin`
--

INSERT INTO `cc_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'adminpass');

-- --------------------------------------------------------

--
-- Table structure for table `cc_cart`
--

CREATE TABLE `cc_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_cart`
--

-- INSERT data as per your need's, or just add product's to the cart through User side.

-- --------------------------------------------------------

--
-- Table structure for table `cc_category`
--

CREATE TABLE `cc_category` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_category`
--

INSERT INTO `cc_category` (`id`, `categories`, `status`, `created_at`) VALUES
(4, 'Milk Chocolate', 1, '2025-07-25 03:53:48'),
(5, 'Dark Chocolate', 1, '2025-07-25 03:54:04'),
(7, 'White Chocolate', 1, '2025-07-26 20:43:02'),
(8, 'Chocolate Bars', 1, '2025-07-28 14:56:55'),
(9, 'Flavored & Filled Chocolates', 1, '2025-07-28 14:57:17'),
(10, 'Gift Pack', 1, '2025-07-28 15:06:03'),
(12, 'Fruit & Nut Chocolates', 1, '2025-07-31 02:15:13'),
(14, 'Baking & Cooking Chocolates', 0, '2025-07-31 02:16:19'),
(15, 'Truffles & Pralines', 0, '2025-07-31 02:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `cc_contact`
--

CREATE TABLE `cc_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_contact`
--
-- INSERT the data as per your need/ Or just fill up the Contact Us form

-- --------------------------------------------------------

--
-- Table structure for table `cc_order`
--

CREATE TABLE `cc_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `order_status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `promo_code` varchar(25) NOT NULL,
  `discount` float NOT NULL,
  `final_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_order`
--

-- INSERT the data as per your need, or just order from the client side.

-- --------------------------------------------------------

--
-- Table structure for table `cc_order_details`
--

CREATE TABLE `cc_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_order_details`
--

-- INSERT the data as per your need, or just order the chocolates from the client side

-- --------------------------------------------------------

--
-- Table structure for table `cc_order_status`
--

CREATE TABLE `cc_order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_order_status`
--

INSERT INTO `cc_order_status` (`id`, `name`) VALUES
(1, 'Order Placed'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Out for Delivery'),
(5, 'Delivered'),
(6, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `cc_product`
--

CREATE TABLE `cc_product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `selling_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_product`
--

INSERT INTO `cc_product` (`id`, `categories_id`, `name`, `mrp`, `selling_price`, `qty`, `image`, `short_desc`, `description`, `status`) VALUES
(13, 4, 'Dairy Milk', 50, 45, 108, '949354754_milk_chocolate.jpg', 'Creamy, smooth milk chocolate that melts delightfully on your tongue — a timeless classic.', 'Dairy Milk offers a rich and velvety chocolate experience made from the finest milk and cocoa. Its smooth texture and balanced sweetness create the perfect harmony of flavors that chocolate lovers adore. Whether as a quick treat or a sharing delight, Dairy Milk never fails to bring comfort and joy. Perfect for everyday indulgence or gifting to those special moments.', 1),
(14, 5, 'Amul Dark Chocolate', 130, 120, 108, '393890963_dark_chocolate.jpg', 'Bold and intense dark chocolate crafted to satisfy true cocoa lovers’ cravings.', 'Amul Dark Chocolate offers a rich, deep cocoa experience with a perfect balance of bitterness and sweetness. Made from premium cocoa beans, it delivers a smooth yet robust flavor that dark chocolate enthusiasts cherish. Ideal for those seeking a healthier indulgence or a sophisticated treat, Amul Dark Chocolate is perfect for savoring alone or sharing special moments. Its velvety texture and intense aroma make every bite a memorable delight.', 1),
(15, 7, 'Cocoatini White Chocolate', 120, 110, 69, '775544246_white_chocolate.webp', 'Lusciously creamy white chocolate with subtle hints of vanilla — a pure delight for sweet lovers.', 'Cocoatini White Chocolate is a velvety smooth treat that melts effortlessly, delivering a delicate vanilla aroma and rich milky sweetness. Crafted with the finest ingredients, it’s perfect for those who adore the gentle, buttery flavor of white chocolate. Whether enjoyed as a dessert or paired with your favorite beverage, Cocoatini White Chocolate promises a luxurious indulgence that brightens any moment. Its creamy texture and sweet finish make it an irresistible choice.', 1),
(16, 8, 'Royce Chocolate Bars', 150, 145, 108, '636229425_royce.webp', 'Exquisite, handcrafted chocolate bars delivering rich, velvety flavor with every bite.', 'Royce Chocolate Bars are a luxurious treat crafted with meticulous care and premium cocoa. Known for their silky smooth texture and complex flavor profiles, these bars blend rich cocoa intensity with subtle sweetness. Perfect for chocolate connoisseurs, Royce bars elevate the everyday chocolate experience into a sophisticated indulgence. Whether gifted or savored solo, each bite promises pure chocolate bliss wrapped in elegant simplicity.', 1),
(17, 9, 'Galaxy Fruit & Nut', 135, 120, 108, '433757242_galaxy.webp', 'Smooth, creamy chocolate packed with crunchy nuts and juicy fruit pieces — pure delight in every bite.', 'Galaxy Fruit & Nut combines velvety smooth milk chocolate with a delightful mix of crunchy roasted nuts and succulent dried fruits. Each bite offers a perfect balance of rich creaminess and textured bursts of flavor, making it a favorite for those who love variety in their chocolate. Crafted with care, this bar delivers indulgence and satisfaction, whether as a snack or a thoughtful gift. Experience the irresistible harmony of fruit, nut, and chocolate all in one.', 1),
(18, 10, 'Cadbury Celebrations', 250, 235, 108, '125491001_cadbury.webp', 'A festive assortment of Cadbury’s finest chocolates — perfect for sharing joy and sweetness.', 'Cadbury Celebrations Gift Pack brings together a delightful collection of premium chocolates crafted to spread happiness on every occasion. From creamy Dairy Milk bars to rich fruit and nut treats, this pack offers something for every chocolate lover. Beautifully packaged, it makes the perfect gift to celebrate festivals, birthdays, or special moments with your loved ones. Experience the joy of giving and the magic of Cadbury’s timeless flavors in one elegant box.', 1),
(19, 8, 'Snickers', 45, 40, 108, '754884211_snickers.jpg', 'Crunchy peanuts, caramel, and nougat wrapped in smooth milk chocolate — the perfect energy-packed treat.', 'Snickers is the ultimate combination of rich milk chocolate, crunchy roasted peanuts, chewy caramel, and soft nougat, delivering a satisfying and indulgent experience in every bite. Known for its bold flavors and hearty texture, Snickers is the go-to snack for a quick energy boost or a delicious treat any time of the day. Whether you’re on-the-go or relaxing, Snickers satisfies hunger and cravings with its perfect balance of sweet and salty goodness.', 1),
(20, 8, 'Hershey\'s Chocolate Bar', 100, 90, 108, '537282318_hersheys.webp', 'Classic American milk chocolate with a creamy, smooth taste that melts perfectly in your mouth.', 'Hershey\'s Chocolate Bar is an iconic treat that offers a nostalgic, rich milk chocolate experience. Crafted with quality ingredients, its smooth texture and sweet flavor make it a beloved favorite worldwide. Perfect for snacking, baking, or sharing, Hershey\'s brings simple joy in every bite. Whether enjoyed alone or paired with your favorite dessert, it’s a timeless indulgence that satisfies chocolate cravings effortlessly.', 1),
(21, 8, 'Kit Kat', 35, 30, 108, '475295725_kitkat.webp', 'Crispy wafer layers wrapped in smooth milk chocolate — the perfect break-time treat.', 'Kit Kat combines crunchy, light wafer layers with a luscious milk chocolate coating to deliver a uniquely satisfying texture and flavor. Known for its iconic “Have a Break, Have a Kit Kat” slogan, this chocolate bar is the ideal companion for a quick snack or a sweet pick-me-up anytime. Perfectly balanced between crisp and creamy, Kit Kat offers a delightful break from your day with every bite. Its convenient size and irresistible taste make it a favorite for all ages.', 1),
(22, 8, '5 Star 3D', 35, 30, 108, '543856998_5star.png', 'Rich caramel and creamy nougat wrapped in smooth milk chocolate — an explosion of flavor and texture.', '5 Star 3D is a delightful treat featuring layers of luscious caramel and soft nougat encased in a velvety milk chocolate shell. Its unique 3D texture adds an exciting crunch, making every bite a delicious adventure. Perfect for those who love a chewy yet crispy chocolate experience, 5 Star 3D offers a satisfying combination of sweetness and richness. Whether as a quick snack or a sharing delight, it’s sure to brighten your day with every mouthful.', 1),
(23, 4, 'Dove Milk Chocolate', 60, 50, 108, '560307712_dove.jpg', 'Silky, smooth, and irresistibly creamy — Dove Milk Chocolate melts in your mouth and melts your heart.', 'Experience the rich, velvety texture of Dove Milk Chocolate — a treat that indulges your senses with every bite. Made with premium milk and the finest cocoa, it delivers a perfectly smooth, melt-in-the-mouth feel. Whether you’re unwinding after a long day or craving a sweet escape, Dove wraps you in a moment of pure delight. Each piece promises comfort, satisfaction, and just the right amount of sweetness. Go ahead — unwrap the luxury you deserve.', 1),
(24, 4, 'Milka Milk Chocolate', 50, 40, 108, '397303903_milka.jpg', 'Creamy, alpine-fresh, and oh-so-satisfying — Milka Milk Chocolate is a melt-in-mouth masterpiece.', 'Crafted with 100% Alpine milk, Milka Milk Chocolate is known for its signature smoothness and gentle sweetness. Every bite offers a velvety, melt-in-mouth experience that feels like a soft hug to your taste buds. With its rich, creamy texture and high-quality cocoa, Milka has become a beloved chocolate across the globe. It\'s the perfect indulgence for any moment — from cozy evenings to sweet surprises. Dive into the magic of Milka and rediscover what true comfort tastes like.', 1),
(25, 4, 'Leonidas Milk Hazelnuts', 250, 249, 108, '295526555_leonidas.webp', 'Crunchy roasted hazelnuts wrapped in silky milk chocolate — a luxurious bite of Belgian bliss.', 'Leonidas Milk Hazelnuts combine the timeless creaminess of premium Belgian milk chocolate with the irresistible crunch of perfectly roasted hazelnuts. Each bite delivers a harmonious balance of smooth sweetness and nutty richness. Known for its purity and craftsmanship, Leonidas uses only the finest ingredients, free from palm oil and artificial flavorings. The hazelnuts are carefully selected and generously blended into the chocolate, offering a satisfying texture with every taste. Ideal for gifting or indulging, it’s a gourmet treat for true chocolate connoisseurs.', 1),
(27, 4, 'MRBEAST BAR', 999, 599, 108, '154216045_mrbeast.jpg', 'Crafted with clean ingredients and bold flavors — MrBeast Bar is chocolate with a mission.', 'MrBeast Bar is not just a chocolate treat — it\'s a movement. Made with minimal, high-quality ingredients like organic cocoa and cane sugar, it delivers a rich, satisfying flavor without compromise. Every bar supports ethical sourcing and sustainability, aligning with MrBeast’s commitment to make a difference. From classic milk chocolate to adventurous flavors, each bar is a smooth, guilt-free indulgence. It’s more than chocolate — it’s purpose-driven sweetness. Taste good. Do good.', 1),
(28, 5, 'Cadbury Royal Dark Chocolate', 399, 369, 108, '766446898_royal_dark.webp', 'Indulge in the royal richness — Cadbury’s dark side is smooth, bold, and irresistibly intense.', 'Cadbury Royal Dark Chocolate offers a luxuriously rich experience for true dark chocolate lovers. With its deep cocoa flavor and silky-smooth texture, it strikes the perfect balance between bitterness and sweetness. Crafted from the finest ingredients, this bar delivers a satisfying, velvety bite that lingers on the palate. It’s a refined twist on classic Cadbury goodness — elegant, intense, and deeply indulgent. Perfect for those craving sophistication in every square. Treat yourself to a truly royal escape.', 1),
(29, 5, 'Green Black\'s Organic', 499, 450, 108, '808716446_green_black.avif', 'Pure. Rich. Grown with care — Green & Black’s Organic is chocolate in its most honest form.', 'Green & Black’s Organic Chocolate is a celebration of purity, sustainability, and indulgence. Crafted from organically grown cocoa beans, each bar delivers a deep, complex flavor that reflects its ethical roots. Smooth, slightly bitter, and perfectly balanced, it\'s a gourmet treat for conscious chocolate lovers. The chocolate melts slowly, unveiling layers of taste that are both luxurious and natural. Whether dark or milk, every bite speaks of quality, care, and authenticity. Experience chocolate as nature intended — responsibly delicious.', 1),
(30, 5, 'Ghirardelli Intense Dark', 555, 499, 108, '781925896_ghirardelli.avif', 'Bold, luxurious, and deeply satisfying — Ghirardelli Intense Dark is the ultimate dark chocolate experience.', 'Ghirardelli Intense Dark offers a rich, velvety chocolate experience crafted for true dark chocolate enthusiasts. Made with premium quality cocoa, its deep and complex flavor unfolds smoothly with each bite. Whether it\'s 72%, 86%, or 92% cacao, each variety brings a perfect balance of intensity and smoothness. The signature snap and melt-in-mouth texture elevate your chocolate moments. It\'s indulgence with sophistication — perfect for savoring solo or pairing with wine, fruits, and more. Ghirardelli makes dark chocolate... darker and better.', 1),
(31, 5, 'Lindt Excellence', 569, 555, 108, '168415402_lindt.avif', 'Experience smooth, rich, and refined chocolate perfection with Lindt Excellence — crafted by Swiss master chocolatiers.', 'Lindt Excellence is the epitome of fine dark chocolate, delivering an exquisite blend of smooth texture and intense cocoa flavor. Each bar is carefully crafted by Lindt’s Swiss chocolatiers using high-quality ingredients and decades of tradition. With options like 70%, 85%, and 90% cocoa, it caters to every dark chocolate lover’s palette. Its thin, delicate squares melt luxuriously on the tongue, offering notes of fruit, spice, or floral undertones. Whether paired with coffee or savored on its own, Lindt Excellence is a taste of chocolate artistry.', 1),
(32, 12, 'Bikaji Mango Chocolates', 450, 425, 108, '227186885_mango.png', 'Tropical mango magic wrapped in velvety chocolate bliss – a juicy twist you can’t resist!', 'Bikaji Mango Chocolates blend the sweet, tangy flavor of real mango with smooth, rich chocolate for a refreshing yet indulgent treat. Each bite bursts with tropical fruitiness, perfectly balanced by the creamy cocoa base. A true fusion of traditional Indian mango essence and modern chocolate artistry. Ideal for gifting, sharing, or satisfying your summer cravings. Let this delightful combo take your taste buds on a flavorful ride!', 1),
(33, 12, 'Kery Mix Fruit', 120, 119, 108, '690549495_kery.jpg', 'Fruity fusion meets chocolaty perfection – taste the rainbow in every bite!', 'Kery Mix Fruit Chocolate offers a delicious medley of fruity flavors wrapped in smooth, creamy chocolate. Bursting with real fruit bits and exotic essences, every bite delivers a sweet, tangy surprise. The perfect blend of natural fruitiness and rich cocoa makes it a treat you’ll crave again and again. Whether you’re gifting or indulging, it’s a colorful, flavorful escape from the ordinary. Let Kery awaken your senses with its playful, juicy charm.', 1),
(34, 12, 'Dairy Milk Fruit Nut', 135, 110, 108, '289493496_dairy_milk_fruit.webp', 'A timeless blend of creamy chocolate, juicy fruits, and crunchy nuts — pure delight in every bite!', 'Dairy Milk Fruit & Nut combines the smooth, velvety richness of Dairy Milk chocolate with the wholesome crunch of roasted nuts and the sweet burst of dried fruits. This classic treat balances creamy sweetness with nutty textures and fruity zest, creating a truly satisfying experience. Perfect for sharing or savoring alone, it’s a timeless favorite that never fails to satisfy your chocolate cravings. Dive into this delightful harmony and enjoy the ultimate chocolate indulgence.', 1),
(35, 12, 'Bournville Fruit & Nut', 255, 250, 108, '740902430_bournville.webp', 'Intense dark chocolate meets luscious fruits and crunchy nuts for a bold, irresistible treat!', 'Bournville Fruit & Nut offers a rich, dark chocolate experience enhanced with the natural sweetness of dried fruits and the satisfying crunch of premium nuts. This luxurious blend delivers a perfect balance between bittersweet cocoa and wholesome textures, making it ideal for those who crave sophistication in every bite. Whether as a daily indulgence or a special treat, Bournville Fruit & Nut promises deep flavor and pure delight. Experience the elegance of dark chocolate with a fruity twist.', 1),
(36, 12, 'Artisante Fruit & Nut', 295, 280, 108, '175421384_artisante.webp', 'Handcrafted chocolate blended with luscious fruits and crunchy nuts for an artisanal delight!', 'Artisante Fruit & Nut is a masterful blend of rich, creamy chocolate combined with the natural sweetness of dried fruits and the satisfying crunch of premium nuts. Each bite offers a handcrafted experience that celebrates authentic flavors and textures. Perfect for chocolate lovers who appreciate artisanal quality, this chocolate bar delights with its balanced richness and delightful bursts of fruity and nutty goodness. Elevate your snack time with the refined taste of Artisante.', 1),
(37, 9, 'Ferrero Rocher', 650, 640, 108, '562795553_ferrero.jpg', 'Crisp hazelnuts wrapped in creamy chocolate bliss, a luxurious treat for every occasion!', 'Ferrero Rocher combines whole roasted hazelnuts enveloped in a smooth, creamy filling and encased in a delicate wafer shell coated with rich milk chocolate and crushed hazelnuts. This iconic confection is renowned worldwide for its perfect harmony of textures and flavors, offering a decadent indulgence with every bite. Whether shared or savored alone, Ferrero Rocher is the ultimate symbol of elegance and gourmet delight. Treat yourself or your loved ones to this exquisite chocolate experience.', 1),
(38, 9, 'Fabelle Filled Chocolates', 195, 185, 108, '763664624_fabelle.jpg', 'Indulgence redefined – rich couverture chocolate filled with luscious surprises!', 'Fabelle Filled Chocolates bring you a luxurious fusion of rich, velvety couverture chocolate with exquisite creamy, nutty, or fruity centers. Crafted by expert chocolatiers, each piece delivers a multi-sensory experience with smooth textures and deep, layered flavors. Whether it’s gooey caramel, silky ganache, or nut-infused delight, every bite is a journey into indulgence. Perfect for gifting or savoring solo, Fabelle takes chocolate artistry to a whole new level.', 1),
(39, 9, 'Savor True Bars', 295, 285, 108, '145382691_savor.jpg', 'Honest ingredients, unforgettable taste – the bar your soul craves!', 'Savor True Bars are crafted for those who seek purity with pleasure. Made from real, wholesome ingredients and rich chocolate blends, every bite offers a guilt-free indulgence that feels as good as it tastes. With unique combinations of fruits, nuts, and natural sweetness, these bars are as nourishing as they are delicious. Whether you\'re fueling a busy day or treating yourself mindfully, Savor True Bars deliver authenticity in every square.', 1),
(40, 9, 'Ziaho Mango Chocolate', 350, 345, 108, '800192552_ziaho.webp', 'Where tropical mango meets velvety chocolate – a bite of exotic bliss!', 'Ziaho Mango Chocolate is a unique fusion of juicy mango flavor wrapped in smooth, melt-in-your-mouth chocolate. Each bite bursts with a sweet-tangy tropical twist that perfectly complements the richness of cocoa. Ideal for those who crave something out of the ordinary, this treat transports your taste buds to a sun-kissed paradise. Whether gifted or enjoyed solo, Ziaho promises a refreshingly bold chocolate experience. Embrace the mango magic with every square!', 1),
(41, 9, 'Pascati Filled Choco', 550, 525, 108, '975905490_pascati.webp', 'Indulge in luxury – rich chocolate with a luscious surprise inside!', 'Pascati Filled Choco is a gourmet delight crafted for true chocolate connoisseurs. Every square unveils a velvety center filled with rich, creamy goodness that melts in your mouth. Made with ethically sourced ingredients and premium cocoa, it\'s a perfect balance of texture and taste. Ideal for both gifting and personal indulgence, Pascati takes you on a smooth, flavorful journey. Dive into this elegant treat that speaks the language of pure indulgence!', 1),
(43, 7, 'LIndt Swiss Classy', 305, 295, 108, '954533615_lindtswiss.jpg', 'Smooth, velvety, and authentically Swiss — a timeless chocolate indulgence.', 'Lindt Swiss Classic is a beloved masterpiece crafted by Lindt’s expert chocolatiers using traditional Swiss recipes. Made with the finest cocoa and creamy Alpine milk, it delivers a rich, melt-in-your-mouth experience with every bite. The balanced sweetness and silky texture make it perfect for everyday indulgence or gifting. Whether you’re savoring it alone or sharing with loved ones, Lindt Swiss Classic brings the luxurious essence of Switzerland straight to your senses. A true classic that never goes out of style!', 1),
(44, 10, 'Chocolate Box', 1995, 1990, 108, '441376163_box.jpg', 'A box full of bliss — assorted chocolates crafted to melt hearts and taste buds.', 'Indulge in the ultimate chocolate experience with our premium Chocolate Box, filled with a handpicked selection of rich, creamy, and irresistibly smooth chocolates. From nut-filled delights to luscious caramel centers, each bite delivers pure joy. Perfect for gifting or treating yourself, this box brings together a variety of flavors to please every palate. Wrapped in elegance and love, it’s not just chocolate — it’s a moment of happiness in every piece. Ideal for birthdays, anniversaries, or just because!', 1),
(47, 7, 'Heidi Creamy White', 295, 270, 108, '140618882_heidi.jpg', 'Lusciously creamy white chocolate with subtle hints of vanilla — a pure delight for sweet lovers.', 'Lusciously creamy white chocolate with subtle hints of vanilla — a pure delight for sweet lovers.', 1),
(49, 8, 'Munch Nuts Max', 35, 30, 108, '527181724_munch.webp', 'Munch is a light, crispy wafer chocolate bar coated with rich chocolate, perfect for a quick bite of crunch and sweetness.', 'Munch is a delightful chocolate snack made with multiple layers of crispy wafer, generously coated with a smooth chocolate layer. Loved by all age groups, it offers the perfect combination of crunchiness and chocolaty sweetness in every bite. Whether you\'re taking a break, sharing with friends, or just craving something light and tasty, Munch is an ideal choice for a quick and satisfying treat. Its convenient size and irresistible flavor make it a favorite in lunchboxes, pockets, and candy jars.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cc_promo`
--

CREATE TABLE `cc_promo` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_promo`
--

INSERT INTO `cc_promo` (`id`, `code`, `rate`) VALUES
(1, 'SVET', 10),
(2, 'HH_MAM', 50),
(3, 'GT_SIR', 50);

-- --------------------------------------------------------

--
-- Table structure for table `cc_users`
--

CREATE TABLE `cc_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pswd` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cc_users`
--

-- INSERT the data as per your need or just register new user's from the verified credential's.

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cc_admin`
--
ALTER TABLE `cc_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_cart`
--
ALTER TABLE `cc_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_category`
--
ALTER TABLE `cc_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_contact`
--
ALTER TABLE `cc_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_order`
--
ALTER TABLE `cc_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_order_details`
--
ALTER TABLE `cc_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_order_status`
--
ALTER TABLE `cc_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_product`
--
ALTER TABLE `cc_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_promo`
--
ALTER TABLE `cc_promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_users`
--
ALTER TABLE `cc_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cc_admin`
--
ALTER TABLE `cc_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cc_cart`
--
ALTER TABLE `cc_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `cc_category`
--
ALTER TABLE `cc_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cc_contact`
--
ALTER TABLE `cc_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cc_order`
--
ALTER TABLE `cc_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `cc_order_details`
--
ALTER TABLE `cc_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `cc_order_status`
--
ALTER TABLE `cc_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cc_product`
--
ALTER TABLE `cc_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cc_promo`
--
ALTER TABLE `cc_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cc_users`
--
ALTER TABLE `cc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
