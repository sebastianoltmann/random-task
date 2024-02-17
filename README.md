### Sebastian Oltmann (oltmann.sebastian@gmail.com)

### Senior Full Stack PHP Developer

Link do oferty pracy: [Senior Full Stack PHP Developer](https://justjoin.it/offers/puzzleup-sp-z-o-o-senior-full-stack-php-developer){:target="_blank"}

### Opis działania

Wysyłając request na wskazany endpoint odkładany jest log temperatury w bazie danych.
Po utworzeniu logu emitowany jest `event` , który jest nasłuchiwany przez odpowiedni `listener`.
`Listener` uruchamia metodę w agregacie, który posiada zaimplementowana logike od tego czy ma zostać wysłane powiadomienie (sprawdzenie temperatury).
Jeśli temperatura jest zbyt niska wówczas emitowany jest kolejny `event` notyfikacji, który jest nasłuchiwany przez `listener` uruchamiający tworznie notyfikacji o statusie `init` w bazie danych.
Następnie w cronie uruchomiona jest komenda, która wyszukuje notyfikacje do wysłania i uruchamia serwis implementujący wiele strategi wysyłki powiadomień w zależności od konfiguracji.
Finalnie w strategiach wysyłane są powiadomienia różnymi kanałami oraz zmieniany jest status notyfikacji na `sent` lub `error` w przypadku błędu.

### Założenia

Podczas implementacji zdecydowałem się rozszerzyć API o wsparcie dla wersionowania co umożliwia lepszą separacje nowych wersji oraz daje wiekszą elastyczność.
W wyniku czego finalny adres endpointa to `api/v1/temperature`.

Moimi najważniejszymi założeniami było to aby odkłądać każdy log dla termostatu, co zapewni poźniejsza możliwość na generowanie raportów oraz wsparcie dla możliwość wysyłania powiadomień wieloma kanałami.
Obecnie zaimplementowana jest tylko jedna możliwość wysyłki powiadomień, ale w przyszłości można to łatwo rozszerzyć.

### Pytania na refinement

- Jaki jest cel biznesowy takiej funkcjonalności?
- Jak ma wygladać walidacja daty jeśli chodzi o ewentualne powtórzenia?
- Jakie docelowo mają być obsługiwane rodzaje powiadomień? (email, sms, push, inny)
- Czy w przypadku błędu wysyłki ma być możliwość ponowienia wysyłki?
- Czy ma być możliwość zdefiniowania własnych szablonów wiadomości?
- Czy logi odnośnie temperatury mają być zapisywane w bazie danych w celu ewentualnej analizy i raportów?
