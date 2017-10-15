##I. OGÓLNY ZARYS DZIAŁANIA
Chmura operać się będzie na mySQLu, którego budowa zostanie określona poniżej. Użytkownik będzie za pomocą witryny umieszczał plik/katalog na serwerze, a sam serwer umieścli go w katalogu z plikami(być może będzie tworzony katalog dla kazdego użytkownika; jeśli nie - wszystkie pliki luzem w jednym katalogu. Przy wysłaniu pliku zostanie utworzony wpis w bazie danych, który będzie zawierał nazwę pliku, unikalny identyfikator oraz właściciela, natomias plik po stronie serwera zmieni nazwę do postaci swojego identyfikatora (np. 0000001,17483943 lub 23545554.jpg - zobaczymy, czy zapiszemy z rozszerzeniem). Obsługiwane również będą “wirtualne katalogi” - w bazie danych będą miały charakter plików, jednak nada się im nieco inne parametry, np DIR. Każdy plik będzie posiadał pid - identyfikator obiektu nadrzędnego, czyli nic innego jak id folderu, w którym sie znajduje - to umożliwi wejście do katalogów oraz rozwiązanie problemu unikalności nazw folderów(domyślnie=0). Na pewno ustawi się limit pliku, np. 20MB. Ze strony klienta webowego będzie do zrobienia panel logowania, eksplorator plików, menu wysyłania/pobierania/usuwania plików, panel administratora do zarządzania wszystkimi plikami.

##II. STRUKTURA MYSQL (PHPMYADMIN)
Nazwa tabeli : Users
Kolumny: id, login, password, permissions, registerdate, storage

Nazwa tabeli : Files
Kolumny: id, pid, name, ext, owner, type, update, size, path

Nazwa tabeli : Log
Kolumny: id, type, text, date, owner

Myślę, że to wystarczy. Są użytkownicy, jest system uprawnień, jest przydział pamięci. W plikach mamy obsługę katalogów, rozmiar pliku(preferowalnie w KB), ścieżka dostępu na serwerze, data wysłania.
Tabela log jest opcjonalna, ale może pomóc adminowi z panelu admina śledzenie błędów np. podczas wysyłania plików.

##III. STRUKTURA PLIKÓW NA SERWERZE
[root]
index.php - Launcher sesji chmury. Jeśli niezalogowany -> engine/loginform.php. Jeśli 			zalogowany -> engine/filemanager.php.
[root/files] //pliki uploadowane na serwer


[root/engine] //pliki PHP
loginform.php - Ekran logowania. Zawiera przycisk do rejestracji -> registerform.php
login.php - Skrypt logowania.
registerform.php - Ekran rejestracji.
register.php - Skrypt rejestracji.
home.php - Panel użytkownika. Zawiera informacje o użytk., % zajętego miejsca, statystyki 		itp.
logout.php - Skrypt wylogowania.
unregister.php - Skrypt usuwania konta wraz z danymi.
filemanager.php - Menadżer plików. Wyświetla pliki/foldery posiadające określony pid w 		tabeli. Po kliknięciu na plik -> openfile.php. Po kliknięciu na katalog -> 					filemanager.php?dir=<pid>. Można też pobrać/usunąć/dodać plik.
openfile.php - Ekran otwierania pliku. W podstawowej wersji umożliwia tylo podgląd nazwy 		i pobranie pliku. W przyszłości pojawi się odtwarzacz HTML5.
uploadfileform.php - Ekran wysyłania pliku na serwer. -> uploadfile.php
uploadfile.php - Skrypt wysyłania pliku na serwer.
downloadfile.php - Skrypt pobrania pliku z serwera.
deletefileform.php - Alert usuwania pliku/katalogu. -> deletefile.php
deletefile.php - Skrypt usunięcia pliku/katalogu/katalogu z plikami.
panellogin.php - Panel użytkownika zaczepiony u góry strony. Załączany do każdego 			ekranu.
panelstat.php - Panel statystyk(%wolnego miejsca, plików). Załączany na wybranych 		stronach w stopce.
adminmgmt.php - Ekran zarządzania serwerem plików. Wyślwietla wszystkie pliki na 			serwerze (obowiązkowo zawijanie strony!). Umożliwia dostęp do ->viewlog.php.
viewlog.php - Wyświetla logi serwera.
config.php - Plik konfiguracyjny z danymi dostępu do serwera.
filemvform.php - Menu wyboru ścieżki docelowej dla kopiowania/przenoszenia pliku. -> 		filemv.php?action=[copy|move]&filename=[filename]&target=[target].
filemv.php - Skrypt kopiowania/przenoszenia plików.


[root/css] //pliki stylów CSS


[root/img] //pliki tekstur buttonów, UI
