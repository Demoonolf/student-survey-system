

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `group_name` varchar(20) DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `illness` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `travel_time` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `parent_phone` varchar(20) DEFAULT NULL,
  `additional_clubs` text DEFAULT NULL,
  `document_number` varchar(50) DEFAULT NULL,
  `iin` varchar(12) DEFAULT NULL,
  `living_status` enum('общежитие','съёмное','у родителей','свой дом') DEFAULT NULL,
  `special_needs` text DEFAULT NULL,
  `foreign_languages` text DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `social_status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
