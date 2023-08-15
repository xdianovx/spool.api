<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => "jeka",
            'email' => "Admin@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$G6Lo0X6pweXhtbstsM273OVtSEB/dh.qu00mP6Mqj36Uot4Wth37W', // password
        ]);
        $countries = array(

            array(
                'flag' => '🇦🇺',
                'name' => 'Австралия'
            ),
            array(
                'flag' => '🇦🇹',
                'name' => 'Австрия'
            ),
            array(
                'flag' => '🇦🇿',
                'name' => 'Азербайджан'
            ),
            array(
                'flag' => '🇦🇽',
                'name' => 'Аландские острова'
            ),
            array(
                'flag' => '🇦🇱',
                'name' => 'Албания'
            ),
            array(
                'flag' => '🇩🇿',
                'name' => 'Алжир'
            ),
            array(
                'flag' => '🇦🇸',
                'name' => 'Американское Самоа'
            ),
            array(
                'flag' => '🇦🇮',
                'name' => 'Ангилья'
            ),
            array(
                'flag' => '🏴󠁧󠁢󠁥󠁮󠁧󠁿',
                'name' => 'Англия'
            ),
            array(
                'flag' => '🇦🇴',
                'name' => 'Ангола'
            ),
            array(
                'flag' => '🇦🇩',
                'name' => 'Андорра'
            ),
            array(
                'flag' => '🇦🇶',
                'name' => 'Антарктида'
            ),
            array(
                'flag' => '🇦🇬',
                'name' => 'Антигуа и Барбуда'
            ),
            array(
                'flag' => '🇦🇷',
                'name' => 'Аргентина'
            ),
            array(
                'flag' => '🇦🇲',
                'name' => 'Армения'
            ),
            array(
                'flag' => '🇦🇼',
                'name' => 'Аруба'
            ),
            array(
                'flag' => '🇦🇫',
                'name' => 'Афганистан'
            ),
            array(
                'flag' => '🇧🇸',
                'name' => 'Багамские Острова'
            ),
            array(
                'flag' => '🇧🇩',
                'name' => 'Бангладеш'
            ),
            array(
                'flag' => '🇧🇧',
                'name' => 'Барбадос'
            ),
            array(
                'flag' => '🇧🇭',
                'name' => 'Бахрейн'
            ),
            array(
                'flag' => '🇧🇿',
                'name' => 'Белиз'
            ),
            array(
                'flag' => '🇧🇾',
                'name' => 'Белоруссия'
            ),
            array(
                'flag' => '🇧🇪',
                'name' => 'Бельгия'
            ),
            array(
                'flag' => '🇧🇯',
                'name' => 'Бенин'
            ),
            array(
                'flag' => '🇧🇲',
                'name' => 'Бермудские Острова'
            ),
            array(
                'flag' => '🇧🇬',
                'name' => 'Болгария'
            ),
            array(
                'flag' => '🇧🇴',
                'name' => 'Боливия'
            ),
            array(
                'flag' => '🇧🇶',
                'name' => 'Бонайре, Синт-Эстатиус и Саба'
            ),
            array(
                'flag' => '🇧🇦',
                'name' => 'Босния и Герцеговина'
            ),
            array(
                'flag' => '🇧🇼',
                'name' => 'Ботсвана'
            ),
            array(
                'flag' => '🇧🇷',
                'name' => 'Бразилия'
            ),
            array(
                'flag' => '🇮🇴',
                'name' => 'Британская Территория в Индийском Океане'
            ),
            array(
                'flag' => '🇧🇳',
                'name' => 'Бруней'
            ),
            array(
                'flag' => '🇧🇫',
                'name' => 'Буркина-Фасо'
            ),
            array(
                'flag' => '🇧🇮',
                'name' => 'Бурунди'
            ),
            array(
                'flag' => '🇧🇹',
                'name' => 'Бутан'
            ),
            array(
                'flag' => '🇻🇺',
                'name' => 'Вануату'
            ),
            array(
                'flag' => '🇻🇦',
                'name' => 'Ватикан'
            ),
            array(
                'flag' => '🇬🇧',
                'name' => 'Великобритания'
            ),
            array(
                'flag' => '🇭🇺',
                'name' => 'Венгрия'
            ),
            array(
                'flag' => '🇻🇪',
                'name' => 'Венесуэла'
            ),
            array(
                'flag' => '🇻🇬',
                'name' => 'Виргинские Острова (Великобритания)'
            ),
            array(
                'flag' => '🇻🇮',
                'name' => 'Виргинские Острова (США)'
            ),
            array(
                'flag' => '🇺🇲',
                'name' => 'Внешние малые острова США'
            ),
            array(
                'flag' => '🇹🇱',
                'name' => 'Восточный Тимор'
            ),
            array(
                'flag' => '🇻🇳',
                'name' => 'Вьетнам'
            ),
            array(
                'flag' => '🇬🇦',
                'name' => 'Габон'
            ),
            array(
                'flag' => '🇭🇹',
                'name' => 'Республика Гаити'
            ),
            array(
                'flag' => '🇬🇾',
                'name' => 'Гайана'
            ),
            array(
                'flag' => '🇬🇲',
                'name' => 'Гамбия'
            ),
            array(
                'flag' => '🇬🇭',
                'name' => 'Гана'
            ),
            array(
                'flag' => '🇬🇵',
                'name' => 'Гваделупа'
            ),
            array(
                'flag' => '🇬🇹',
                'name' => 'Гватемала'
            ),
            array(
                'flag' => '🇬🇫',
                'name' => 'Гвиана'
            ),
            array(
                'flag' => '🇬🇳',
                'name' => 'Гвинея'
            ),
            array(
                'flag' => '🇬🇼',
                'name' => 'Гвинея-Бисау'
            ),
            array(
                'flag' => '🇩🇪',
                'name' => 'Германия'
            ),
            array(
                'flag' => '🇬🇬',
                'name' => 'Гернси'
            ),
            array(
                'flag' => '🇬🇮',
                'name' => 'Гибралтар'
            ),
            array(
                'flag' => '🇭🇳',
                'name' => 'Гондурас'
            ),
            array(
                'flag' => '🇭🇰',
                'name' => 'Гонконг'
            ),
            array(
                'flag' => '🇬🇩',
                'name' => 'Гренада'
            ),
            array(
                'flag' => '🇬🇱',
                'name' => 'Гренландия'
            ),
            array(
                'flag' => '🇬🇷',
                'name' => 'Греция'
            ),
            array(
                'flag' => '🇬🇪',
                'name' => 'Грузия'
            ),
            array(
                'flag' => '🇬🇺',
                'name' => 'Гуам'
            ),
            array(
                'flag' => '🇩🇰',
                'name' => 'Дания'
            ),
            array(
                'flag' => '🇨🇩',
                'name' => 'Демократическая Республика Конго'
            ),
            array(
                'flag' => '🇯🇪',
                'name' => 'Джерси'
            ),
            array(
                'flag' => '🇩🇯',
                'name' => 'Джибути'
            ),
            array(
                'flag' => '🇩🇲',
                'name' => 'Доминика'
            ),
            array(
                'flag' => '🇩🇴',
                'name' => 'Доминиканская Республика'
            ),
            array(
                'flag' => '🇪🇬',
                'name' => 'Египет'
            ),
            array(
                'flag' => '🇿🇲',
                'name' => 'Замбия'
            ),
            array(
                'flag' => '🇪🇭',
                'name' => 'Западная Сахара'
            ),
            array(
                'flag' => '🇿🇼',
                'name' => 'Зимбабве'
            ),
            array(
                'flag' => '🇮🇱',
                'name' => 'Израиль'
            ),
            array(
                'flag' => '🇮🇳',
                'name' => 'Индия'
            ),
            array(
                'flag' => '🇮🇩',
                'name' => 'Индонезия'
            ),
            array(
                'flag' => '🇯🇴',
                'name' => 'Иордания'
            ),
            array(
                'flag' => '🇮🇶',
                'name' => 'Ирак'
            ),
            array(
                'flag' => '🇮🇷',
                'name' => 'Иран'
            ),
            array(
                'flag' => '🇮🇪',
                'name' => 'Ирландия'
            ),
            array(
                'flag' => '🇮🇸',
                'name' => 'Исландия'
            ),
            array(
                'flag' => '🇪🇸',
                'name' => 'Испания'
            ),
            array(
                'flag' => '🇮🇹',
                'name' => 'Италия'
            ),
            array(
                'flag' => '🇾🇪',
                'name' => 'Йемен'
            ),
            array(
                'flag' => '🇨🇻',
                'name' => 'Кабо-Верде'
            ),
            array(
                'flag' => '🇰🇿',
                'name' => 'Казахстан'
            ),
            array(
                'flag' => '🇰🇭',
                'name' => 'Камбоджа'
            ),
            array(
                'flag' => '🇨🇲',
                'name' => 'Камерун'
            ),
            array(
                'flag' => '🇨🇦',
                'name' => 'Канада'
            ),
            array(
                'flag' => '🇶🇦',
                'name' => 'Катар'
            ),
            array(
                'flag' => '🇰🇪',
                'name' => 'Кения'
            ),
            array(
                'flag' => '🇨🇾',
                'name' => 'Республика Кипр'
            ),
            array(
                'flag' => '🇰🇬',
                'name' => 'Киргизия'
            ),
            array(
                'flag' => '🇰🇮',
                'name' => 'Кирибати'
            ),
            array(
                'flag' => '🇨🇳',
                'name' => 'Китай'
            ),
            array(
                'flag' => '🇰🇵',
                'name' => 'КНДР'
            ),
            array(
                'flag' => '🇨🇨',
                'name' => 'Кокосовые острова'
            ),
            array(
                'flag' => '🇨🇴',
                'name' => 'Колумбия'
            ),
            array(
                'flag' => '🇰🇲',
                'name' => 'Коморы'
            ),
            array(
                'flag' => '🇽🇰',
                'name' => 'Республика Косово'
            ),
            array(
                'flag' => '🇨🇷',
                'name' => 'Коста-Рика'
            ),
            array(
                'flag' => '🇨🇮',
                'name' => 'Кот-д’Ивуар'
            ),
            array(
                'flag' => '🇨🇺',
                'name' => 'Куба'
            ),
            array(
                'flag' => '🇰🇼',
                'name' => 'Кувейт'
            ),
            array(
                'flag' => '🇨🇼',
                'name' => 'Кюрасао'
            ),
            array(
                'flag' => '🇱🇦',
                'name' => 'Лаос'
            ),
            array(
                'flag' => '🇱🇻',
                'name' => 'Латвия'
            ),
            array(
                'flag' => '🇱🇸',
                'name' => 'Лесото'
            ),
            array(
                'flag' => '🇱🇷',
                'name' => 'Либерия'
            ),
            array(
                'flag' => '🇱🇧',
                'name' => 'Ливан'
            ),
            array(
                'flag' => '🇱🇾',
                'name' => 'Ливия'
            ),
            array(
                'flag' => '🇱🇹',
                'name' => 'Литва'
            ),
            array(
                'flag' => '🇱🇮',
                'name' => 'Лихтенштейн'
            ),
            array(
                'flag' => '🇱🇺',
                'name' => 'Люксембург'
            ),
            array(
                'flag' => '🇲🇺',
                'name' => 'Маврикий'
            ),
            array(
                'flag' => '🇲🇷',
                'name' => 'Мавритания'
            ),
            array(
                'flag' => '🇲🇬',
                'name' => 'Мадагаскар'
            ),
            array(
                'flag' => '🇾🇹',
                'name' => 'Майотта'
            ),
            array(
                'flag' => '🇲🇴',
                'name' => 'Макао'
            ),
            array(
                'flag' => '🇲🇼',
                'name' => 'Малави'
            ),
            array(
                'flag' => '🇲🇾',
                'name' => 'Малайзия'
            ),
            array(
                'flag' => '🇲🇱',
                'name' => 'Мали'
            ),
            array(
                'flag' => '🇲🇻',
                'name' => 'Мальдивы'
            ),
            array(
                'flag' => '🇲🇹',
                'name' => 'Мальта'
            ),
            array(
                'flag' => '🇲🇦',
                'name' => 'Марокко'
            ),
            array(
                'flag' => '🇲🇶',
                'name' => 'Мартиника'
            ),
            array(
                'flag' => '🇲🇭',
                'name' => 'Маршалловы Острова'
            ),
            array(
                'flag' => '🇲🇽',
                'name' => 'Мексика'
            ),
            array(
                'flag' => '🇲🇿',
                'name' => 'Мозамбик'
            ),
            array(
                'flag' => '🇲🇩',
                'name' => 'Молдавия'
            ),
            array(
                'flag' => '🇲🇨',
                'name' => 'Монако'
            ),
            array(
                'flag' => '🇲🇳',
                'name' => 'Монголия'
            ),
            array(
                'flag' => '🇲🇸',
                'name' => 'Монтсеррат'
            ),
            array(
                'flag' => '🇲🇲',
                'name' => 'Мьянма'
            ),
            array(
                'flag' => '🇳🇦',
                'name' => 'Намибия'
            ),
            array(
                'flag' => '🇳🇷',
                'name' => 'Науру'
            ),
            array(
                'flag' => '🇳🇵',
                'name' => 'Непал'
            ),
            array(
                'flag' => '🇳🇪',
                'name' => 'Нигер'
            ),
            array(
                'flag' => '🇳🇬',
                'name' => 'Нигерия'
            ),
            array(
                'flag' => '🇳🇱',
                'name' => 'Королевство Нидерландов'
            ),
            array(
                'flag' => '🇳🇮',
                'name' => 'Никарагуа'
            ),
            array(
                'flag' => '🇳🇺',
                'name' => 'Ниуэ'
            ),
            array(
                'flag' => '🇳🇿',
                'name' => 'Новая Зеландия'
            ),
            array(
                'flag' => '🇳🇨',
                'name' => 'Новая Каледония'
            ),
            array(
                'flag' => '🇳🇴',
                'name' => 'Норвегия'
            ),
            array(
                'flag' => '🇦🇪',
                'name' => 'ОАЭ'
            ),
            array(
                'flag' => '🇴🇲',
                'name' => 'Оман'
            ),
            array(
                'flag' => '🇧🇻',
                'name' => 'Остров Буве'
            ),
            array(
                'flag' => '🇮🇲',
                'name' => 'Остров Мэн'
            ),
            array(
                'flag' => '🇳🇫',
                'name' => 'Остров Норфолк'
            ),
            array(
                'flag' => '🇨🇽',
                'name' => 'Остров Рождества'
            ),
            array(
                'flag' => '🇭🇲',
                'name' => 'Остров Херд и острова Макдональд'
            ),
            array(
                'flag' => '🇰🇾',
                'name' => 'Острова Кайман'
            ),
            array(
                'flag' => '🇨🇰',
                'name' => 'Острова Кука'
            ),
            array(
                'flag' => '🇵🇳',
                'name' => 'Острова Питкэрн'
            ),
            array(
                'flag' => '🇸🇭',
                'name' => 'Острова Святой Елены, Вознесения и Тристан-да-Кунья'
            ),
            array(
                'flag' => '🇵🇰',
                'name' => 'Пакистан'
            ),
            array(
                'flag' => '🇵🇼',
                'name' => 'Палау'
            ),
            array(
                'flag' => '🇵🇸',
                'name' => 'Государство Палестина'
            ),
            array(
                'flag' => '🇵🇦',
                'name' => 'Панама'
            ),
            array(
                'flag' => '🇵🇬',
                'name' => 'Папуа — Новая Гвинея'
            ),
            array(
                'flag' => '🇵🇾',
                'name' => 'Парагвай'
            ),
            array(
                'flag' => '🇵🇪',
                'name' => 'Перу'
            ),
            array(
                'flag' => '🇵🇱',
                'name' => 'Польша'
            ),
            array(
                'flag' => '🇵🇹',
                'name' => 'Португалия'
            ),
            array(
                'flag' => '🇵🇷',
                'name' => 'Пуэрто-Рико'
            ),
            array(
                'flag' => '🇨🇬',
                'name' => 'Республика Конго'
            ),
            array(
                'flag' => '🇰🇷',
                'name' => 'Республика Корея'
            ),
            array(
                'flag' => '🇷🇪',
                'name' => 'Реюньон'
            ),
            array(
                'flag' => '🇷🇺',
                'name' => 'Россия'
            ),
            array(
                'flag' => '🇷🇼',
                'name' => 'Руанда'
            ),
            array(
                'flag' => '🇷🇴',
                'name' => 'Румыния'
            ),
            array(
                'flag' => '🇸🇻',
                'name' => 'Сальвадор'
            ),
            array(
                'flag' => '🇼🇸',
                'name' => 'Самоа'
            ),
            array(
                'flag' => '🇸🇲',
                'name' => 'Сан-Марино'
            ),
            array(
                'flag' => '🇸🇹',
                'name' => 'Сан-Томе и Принсипи'
            ),
            array(
                'flag' => '🇸🇦',
                'name' => 'Саудовская Аравия'
            ),
            array(
                'flag' => '🇸🇿',
                'name' => 'Эсватини'
            ),
            array(
                'flag' => '🇬🇧',
                'name' => 'Северная Ирландия'
            ),
            array(
                'flag' => '🇲🇰',
                'name' => 'Северная Македония'
            ),
            array(
                'flag' => '🇲🇵',
                'name' => 'Северные Марианские Острова'
            ),
            array(
                'flag' => '🇸🇨',
                'name' => 'Сейшельские Острова'
            ),
            array(
                'flag' => '🇧🇱',
                'name' => 'Сен-Бартелеми'
            ),
            array(
                'flag' => '🇲🇫',
                'name' => 'Сен-Мартен'
            ),
            array(
                'flag' => '🇵🇲',
                'name' => 'Сен-Пьер и Микелон'
            ),
            array(
                'flag' => '🇸🇳',
                'name' => 'Сенегал'
            ),
            array(
                'flag' => '🇻🇨',
                'name' => 'Сент-Винсент и Гренадины'
            ),
            array(
                'flag' => '🇰🇳',
                'name' => 'Сент-Китс и Невис'
            ),
            array(
                'flag' => '🇱🇨',
                'name' => 'Сент-Люсия'
            ),
            array(
                'flag' => '🇷🇸',
                'name' => 'Сербия'
            ),
            array(
                'flag' => '🇸🇬',
                'name' => 'Сингапур'
            ),
            array(
                'flag' => '🇸🇽',
                'name' => 'Синт-Мартен'
            ),
            array(
                'flag' => '🇸🇾',
                'name' => 'Сирия'
            ),
            array(
                'flag' => '🇸🇰',
                'name' => 'Словакия'
            ),
            array(
                'flag' => '🇸🇮',
                'name' => 'Словения'
            ),
            array(
                'flag' => '🇺🇸',
                'name' => 'США'
            ),
            array(
                'flag' => '🇸🇧',
                'name' => 'Соломоновы Острова'
            ),
            array(
                'flag' => '🇸🇴',
                'name' => 'Сомали'
            ),
            array(
                'flag' => '🇸🇩',
                'name' => 'Судан'
            ),
            array(
                'flag' => '🇸🇷',
                'name' => 'Суринам'
            ),
            array(
                'flag' => '🇸🇱',
                'name' => 'Сьерра-Леоне'
            ),
            array(
                'flag' => '🇹🇯',
                'name' => 'Таджикистан'
            ),
            array(
                'flag' => '🇹🇭',
                'name' => 'Таиланд'
            ),
            array(
                'flag' => '🇹🇼',
                'name' => 'Тайвань'
            ),
            array(
                'flag' => '🇹🇿',
                'name' => 'Танзания'
            ),
            array(
                'flag' => '🇹🇨',
                'name' => 'Теркс и Кайкос'
            ),
            array(
                'flag' => '🇹🇬',
                'name' => 'Того'
            ),
            array(
                'flag' => '🇹🇰',
                'name' => 'Токелау'
            ),
            array(
                'flag' => '🇹🇴',
                'name' => 'Тонга'
            ),
            array(
                'flag' => '🇹🇹',
                'name' => 'Тринидад и Тобаго'
            ),
            array(
                'flag' => '🇹🇻',
                'name' => 'Тувалу'
            ),
            array(
                'flag' => '🇹🇳',
                'name' => 'Тунис'
            ),
            array(
                'flag' => '🇹🇲',
                'name' => 'Туркменистан'
            ),
            array(
                'flag' => '🇹🇷',
                'name' => 'Турция'
            ),
            array(
                'flag' => '🇺🇬',
                'name' => 'Уганда'
            ),
            array(
                'flag' => '🇺🇿',
                'name' => 'Узбекистан'
            ),
            array(
                'flag' => '🇺🇦',
                'name' => 'Украина'
            ),
            array(
                'flag' => '🇼🇫',
                'name' => 'Уоллис и Футуна'
            ),
            array(
                'flag' => '🇺🇾',
                'name' => 'Уругвай'
            ),
            array(
                'flag' => '🏴󠁧󠁢󠁷󠁬󠁳󠁿',
                'name' => 'Уэльс'
            ),
            array(
                'flag' => '🇫🇴',
                'name' => 'Фарерские острова'
            ),
            array(
                'flag' => '🇫🇲',
                'name' => 'Федеративные Штаты Микронезии'
            ),
            array(
                'flag' => '🇫🇯',
                'name' => 'Фиджи'
            ),
            array(
                'flag' => '🇵🇭',
                'name' => 'Филиппины'
            ),
            array(
                'flag' => '🇫🇮',
                'name' => 'Финляндия'
            ),
            array(
                'flag' => '🇫🇰',
                'name' => 'Фолклендские острова'
            ),
            array(
                'flag' => '🇫🇷',
                'name' => 'Франция'
            ),
            array(
                'flag' => '🇵🇫',
                'name' => 'Французская Полинезия'
            ),
            array(
                'flag' => '🇹🇫',
                'name' => 'Французские Южные и Антарктические территории'
            ),
            array(
                'flag' => '🇭🇷',
                'name' => 'Хорватия'
            ),
            array(
                'flag' => '🇨🇫',
                'name' => 'Центральноафриканская Республика'
            ),
            array(
                'flag' => '🇹🇩',
                'name' => 'Чад'
            ),
            array(
                'flag' => '🇲🇪',
                'name' => 'Черногория'
            ),
            array(
                'flag' => '🇨🇿',
                'name' => 'Чехия'
            ),
            array(
                'flag' => '🇨🇱',
                'name' => 'Чили'
            ),
            array(
                'flag' => '🇨🇭',
                'name' => 'Швейцария'
            ),
            array(
                'flag' => '🇸🇪',
                'name' => 'Швеция'
            ),
            array(
                'flag' => '🏴󠁧󠁢󠁳󠁣󠁴󠁿',
                'name' => 'Шотландия'
            ),
            array(
                'flag' => '🇸🇯',
                'name' => 'Шпицберген и Ян-Майен'
            ),
            array(
                'flag' => '🇱🇰',
                'name' => 'Шри-Ланка'
            ),
            array(
                'flag' => '🇪🇨',
                'name' => 'Эквадор'
            ),
            array(
                'flag' => '🇬🇶',
                'name' => 'Экваториальная Гвинея'
            ),
            array(
                'flag' => '🇪🇷',
                'name' => 'Эритрея'
            ),
            array(
                'flag' => '🇪🇪',
                'name' => 'Эстония'
            ),
            array(
                'flag' => '🇪🇹',
                'name' => 'Эфиопия'
            ),
            array(
                'flag' => '🇿🇦',
                'name' => 'Южно-Африканская Республика'
            ),
            array(
                'flag' => '🇬🇸',
                'name' => 'Южная Георгия и Южные Сандвичевы Острова'
            ),
            array(
                'flag' => '🇸🇸',
                'name' => 'Южный Судан'
            ),
            array(
                'flag' => '🇯🇲',
                'name' => 'Ямайка'
            ),
            array(
                'flag' => '🇯🇵',
                'name' => 'Япония'
            )

        );
        foreach ($countries as $key => $value) {
            Country::create($value);
        }
    }
}
