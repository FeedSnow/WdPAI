# Seedlings

Projekt *Seedlings* jest stroną z ogłoszeniami o sprzedaży roślin.

---

## Funkcjonalności

### Rejestracja

Podczas rejestracji użytkownik musi podać imię, nazwisko, adres e-mail oraz hasło.
Hasło musi składać się z małych i dużych liter, cyfr oraz znaków specjalnych i zawierać od 8 do 30 znaków. 
Jeśli konto o podanym adresie e-mail już istnieje, nowe nie zostanie zarejestrowane.
Po rejestracji użytkownikowi automatycznie przypisywana jest rola **User** (dalej *"użytkownik"*). Administrator bazy danych może zmienić ją na **Admin** (dalej *"administrator"*).

### Logowanie

Podczas logowania użytkownik musi podać adres e-mail oraz hasło. Jeśli dane są prawidłowe, dane użytkownika zostaną zapisane w sesji, a on zostanie przekierowany na stronę z ofertami.

### Przeglądanie/Wyszukiwanie ofert

Użytkownik może przeglądać wszystkie oferty lub wpisać w pole do wyszukiwania interesujące go hasło. Po wciśnięciu [Enter] lub kliknięciu **lupy** wyświetlone zostaną oferty zawierające w nazwie lub opisie żądane hasło.
Każdy kafelek oferty wyświetla jej zdjęcie, nazwę, opis, cenę oraz adres e-mail osoby wystawiającej.

### Dodawanie ofert

Użytkownik może dodać ofertę. W tym celu musi wczytać zdjęcie oraz podać tytuł, opis, cenę, ilość oraz przynajmniej jedną opcję dostawy.
Jeśli jedną z wybranych opcji (uste pola nie są brane pod uwagę) jest odbiór osobisty, użytkownik musi podać pełny adres odbioru. Państwa poza RP nie są brane pod uwagę, dlatego nie pojawia się pole wyboru kraju.

### Usuwanie ofert

Użytkownik może w dowolnej chwili usunąć dowolną ze swoich ofert za pomocą przycisku w górnym prawym rogu kafelka.
Administrator może usuwać oferty każdego użytkownika.

### Dodawanie kontaktów

Po kliknięciu na adres e-mail na kafelku oferty, użytkownik ją wystawiający zostanie dodany do kontaktów, jeśli jeszcze się w nich nie znajduje.

### Wylogowywanie

Podczas wylogowania dane użytkownika są usuwane z sesji, a on sam zostaje przekierowany do ekranu logowania.

---

## Użyte wzorce projektowe

Singleton w klasach `Database` i `Repository`. 
