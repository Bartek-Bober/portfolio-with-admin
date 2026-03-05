# Mój projekt na praktyki: Portfolio z Panelem Admina

## O projekcie

Zamiast tworzyć zwykłą, statyczną stronę "O mnie" w HTML-u, postanowiłem stworzyć narzędzie, które posłuży mi na dłużej Jest to dynamiczne portfolio wyposażone w dedykowany panel administratora Dzięki temu rozwiązaniu mogę logować się z poziomu przeglądarki i zarządzać treścią – dodawać nowe projekty oraz czytać wiadomości z formularza kontaktowego, bez konieczności ingerencji w kod źródłowy

## Technologie

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Baza danych:** MySQL

## Funkcjonalności

### Część publiczna

Część widoczna dla każdego odwiedzającego

- **Górna Nawigacja:** Przyklejone do góry menu z linkami ułatwiającymi poruszanie się po sekcjach
- **Hero Section:** Przyciągający wzrok nagłówek z krótkim hasłem (np. "Tworzę nowoczesne aplikacje webowe") oraz przyciskiem Call-to-Action przewijającym stronę
- **Sekcja "O mnie":** Krótki opis mojej ścieżki, aktualnej nauki oraz celów rozwojowych
- **Moje Umiejętności:** Wizualna prezentacja znanych technologii w formie ikon (HTML, CSS, JS, PHP, MySQL, Git)
- **Główne Portfolio:** Kafelki reprezentujące zrealizowane projekty (zdjęcie, opis, technologie) z opcją filtrowania
- **Formularz kontaktowy:** Miejsce pozwalające na szybkie wysłanie wiadomości bezpośrednio ze strony

### Panel Administratora

Dostęp chroniony, przeznaczony wyłącznie do zarządzania stroną

- **Ekran Logowania:** Prosty i czysty formularz weryfikujący podany login oraz hasło
- **Zarządzanie Portfolio:** Interfejs z tabelą prac oraz formularzem umożliwiającym dodawanie (tytuł, opis, technologie, kategoria), edycję i usuwanie wpisów
- **Skrzynka odbiorcza:** Lista wszystkich wiadomości przesłanych z formularza kontaktowego na stronie głównej
## Stworzenie migracji
stworzenie pliku
php yii migrate/create create_user_table
uruchomienie
php yii migrate
cofnięcie
php yii migrate