-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 30, 2021 alle 18:28
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progettobasididati_v2b`
--
CREATE DATABASE IF NOT EXISTS `progettobasididati_v2b` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `progettobasididati_v2b`;

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `codiceArticolo` int(11) NOT NULL,
  `autore` int(11) NOT NULL,
  `titolo` varchar(70) NOT NULL,
  `testo` mediumtext NOT NULL,
  `dataScrittura` date NOT NULL,
  `blog` int(11) NOT NULL,
  `numeroCommenti` int(11) NOT NULL DEFAULT 0 CHECK (`numeroCommenti` >= 0),
  `numeroVoti` int(11) NOT NULL DEFAULT 0 CHECK (`numeroVoti` >= 0),
  `mediaVoti` tinyint(4) NOT NULL DEFAULT 0 CHECK (0 <= `mediaVoti` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`codiceArticolo`, `autore`, `titolo`, `testo`, `dataScrittura`, `blog`, `numeroCommenti`, `numeroVoti`, `mediaVoti`) VALUES
(9, 6, 'I consigli per ridurre l’inquinamento', '                    <p style=\"margin-top: 1.27778rem; margin-right: auto; margin-left: auto; font-size: 18.2857px; max-width: 42.6667rem; font-family: Georgia, serif; line-height: 1.27778rem; color: rgb(44, 43, 46);\">Bastano veramente poche azioni e piccolo accorgimenti per fare la differenza e portare il nostro contributo per la creazione di un mondo sostenibile per tutti. Sebbene si possa avere l’impressione che le nostre azioni non contino nulla, in realtà il piccolo consumatore ha un grande potere soprattutto quando possiamo influenzare altre persone con il nostro comportamento, il così detto effetto domino.</p><p style=\"margin-top: 1.27778rem; margin-right: auto; margin-left: auto; font-size: 18.2857px; max-width: 42.6667rem; font-family: Georgia, serif; line-height: 1.27778rem; color: rgb(44, 43, 46);\">Vediamo insieme i consigli per ridurre il nostro impatto sull’ambiente.</p><ul style=\"margin: 0.958333rem auto; font-size: 18.2857px; list-style-position: initial; list-style-image: initial; padding-left: 1.91667rem; max-width: 42.6667rem; color: rgb(44, 43, 46); font-family: Muli, sans-serif;\"><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Utilizzare l’auto il meno possibile</h3><p style=\"font-size: 1em;\">Sebbene possa sembrare banale e scontato, in realtà l’utilizzo smisurato delle auto produce elevati tassi di <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">inquinamento</span> (soprattutto i <a href=\"https://www.repubblica.it/ambiente/2019/01/26/news/gomme_e_freni_l_inquinamento_nascosto_delle_auto_in_citta_-217535750/\" style=\"margin: 0px; font-size: 1em; text-decoration: none; color: rgb(129, 170, 33);\">pneumatici e i freni</a> producono grandi quantità di <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">micropolveri</span> nocive per l’intero organismo). Quante volte usiamo l’auto per dei tragitti insignificanti, che potrebbero essere benissimo compiuti a piedi o con la bicicletta? Oppure usiamo l’auto quando invece potremmo prendere il treno o altri mezzi di trasporto pubblici?L’auto costituisce un grande <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">costo</span> per il consumatore, e non solo in termini di benzina o diesel. Infatti più utilizziamo l’auto e più aumentano le probabilità di incidenti o di arrecano danno alla vettura. Un suo uso costante aumenta, inoltre, in maniera sostanziale <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">l’usura</span> dei veicolo.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Optare per il car-sharing</h3><p style=\"font-size: 1em;\">Talvolta utilizzare la macchina è indispensabile. In questi casi possiamo utilizzare il car-sharing come mezzo <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">ecologico</span> ed alternativo. Con il car-sharing (il più diffuso è<a href=\"http://www.blablacar.it/\" style=\"margin: 0px; font-size: 1em; text-decoration: none; color: rgb(129, 170, 33);\"> blablacar</a>) possiamo sia offrire passaggi in cambio della <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">condivisione</span> delle spese di viaggio, oppure cercare un passaggio con un costo nettamente inferiore rispetto all’utilizzo dell’auto o dei mezzi pubblici.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Ridurre il consumo di carne e pesce</h3><p style=\"font-size: 1em;\">E’ oramai assodato che gli <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">allevamenti intensivi</span> siano grande fonte di <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">inquinamento</span>. Secondo <a href=\"https://www.greenpeace.org/italy/storia/4813/gli-allevamenti-intensivi-seconda-causa-di-inquinamento-da-polveri-sottili/\" style=\"margin: 0px; font-size: 1em; text-decoration: none; color: rgb(129, 170, 33);\"><em style=\"margin: 0px; font-size: 1em;\">Greenpeace</em></a>, infatti, questa tipologia di allevamento sarebbe la seconda causa di inquinamento da polveri sottili. Quando scegliamo di consumare <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">legumi</span> e verdura fresca ne gioverà non soltanto il pianeta e la vostra salute, ma anche il <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">portafoglio</span>, essendo che un kg di manzo ha un prezzo medio che si aggira intorno ai 15€/kg, mentre i legumi hanno un costo medio di 4€/kg.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Consumare frutta e verdura di stagione</h3><p style=\"font-size: 1em;\">Comprare i pomodori a Dicembre è semplicemente <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">un’aberrazione</span>, soprattutto perché in Italia abbiamo una <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">grandissima</span> varietà di frutta e verdura stagionale. Impariamo ad acquistare in base alle stagioni, se proprio vogliamo gustare dei pomodori o della frutta più dolce durante l’inverno, possiamo sempre fare scorta durante l’estate e poi preparare delle conserve o conservare i prodotti acquistati in freezer.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Acquistare frutta e verdura dai produttori</h3><p style=\"font-size: 1em;\">Un’altro grande vantaggio dell’Italia è di avere ancora un settore <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">agricolo</span> particolarmente vivo. Quando acquistiamo la frutta e la verdura dai <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">produttori</span> (ad esempio al <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">mercato</span>) non solo riduciamo l’impatto ambientale del trasporto dei prodotti da una regione all’altra, ma paghiamo un prezzo giusto per un prodotto a km 0. <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">Aiutiamo </span> e <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">incentiviamo</span> così l’economia locale e magari famigliare, anziché far fluire i nostri soldi nelle casse dei grandi ipermercati.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Quando possibile, prediligere i prodotti biologici</h3><p style=\"font-size: 1em;\">I prodotti biologici sono sicuramente più <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">costosi</span> rispetto ai prodotti tradizionali. Questo significa che non sempre possiamo permetterci di acquistare beni di questo tipo. Un primo passo da compiere è sicuramente quello di <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">consumare meno cibo</span>: infatti la nostra società consuma quantità di cibo decisamente elevate per lo stile di vita prevalentemente <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">sedentario</span> che conduce. Una volta ridotta la quantità possiamo concentrarci sulla <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">qualità</span> e quindi concederci degli alimenti biologici. Se anche in questo caso i prodotti biologici continuano ad essere al di fuori della nostra portata, possiamo acquistare solo i beni che ci servono e che troviamo in <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">offerta</span>, oppure concentrarci sui beni a lunga durata e che consumiamo meno (ad esempio, zucchero, farina, ecc).</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Consumare meno</h3><p style=\"font-size: 1em;\">La nostra società è altamente consumista. Siamo perennemente bombardati da messaggi pubblicitari che ci invogliano a <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">consumare</span>, ad acquistare. Spesso siamo tentati di acquistare una t-shirt, anche se non ne abbiamo bisogno, perché ad un prezzo <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">accattivante</span>. Ma pensiamo al costo ambientale ed umano che ha il prodotto che desideriamo? Prima di acquistare qualcosa pensiamo se realmente ne abbiamo bisogno e meditiamo sul costo che ha avuto la produzione di quel determinato bene. E’ anche importante limitare gli acquisti su internet il più possibile, e anche in questo caso prediligere negozi e prodotti locali.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Fare la raccolta differenziata</h3><p style=\"font-size: 1em;\">Differenziare è importantissimo, ma da solo non basta a ridurre il nostro impatto sull’ambiente. Dobbiamo imparare a consumare meno, in modo tale da produrre meno spazzatura e materiali di scarto.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Ridurre l’utilizzo della plastica</h3><p style=\"font-size: 1em;\">La plastica oramai è ovunque. Facciamo quinti attenzione e <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">limitiamo</span> il più possibile l’acquisto di materiale plastico. Ad esempio, sostituiamo le<span style=\"margin: 0px; font-size: 1em; font-weight: 700;\"> bottiglie di plastica</span> con quelle in vetro o alluminio, oppure con la caraffa filtrante. Evitiamo di acquistare <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">cibi già pronti</span> oppure imballati singolarmente. I cibi già pronti, oltre a essere generalmente ricchi di zuccheri, hanno sempre un prezzo superiore rispetto alle materie prime necessarie per la produzione del piatto. Sostituiamo le <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">spugne</span> per la pulizia della casa e del corpo – generalmente in plastica – con spugne naturali e biodegradabili.</p><h3 style=\"font-size: 1em;\">Utilizzare la coppetta mestruale o gli assorbenti lavabili</h3><p style=\"font-size: 1em;\">Gli <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">assorbenti</span>, oltre a costituire un costo monetario elevato, rappresentano un costo ambientale data l’impossibilità di riciclarli e l’elevato uso che se ne fa. Passare alla coppetta mestruale è una <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">rivoluzione</span> sia economica (una coppetta costa sui 20€ e può essere utilizzata per circa 20 anni), che ambientale. Inoltre, a differenza dei tradizionali assorbenti, la coppetta <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">non irrita</span> le parti intime, evitando anche la diffusione del cattivo odore.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Riutilizzare e aggiustare</h3><p style=\"font-size: 1em;\">Capita di essere tentati di gettare un oggetto che può essere aggiustato pensando “costa meno comprarne uno nuovo!”. Invece non è così se pensiamo al costo ambientale che deriva dalla <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">produzione</span> di nuovi oggetti. Cerchiamo, quindi, di aggiustare e riutilizzare ciò che è possibile. Anche quando andiamo al mercato a fare la spesa, ad esempio, possiamo <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">riutilizzare</span> i sacchetti della volta prima e continuarne l’utilizzo fino a quando sarà possibile. Quando abbiamo bisogno di qualcosa è sempre bene valutare se è possibile acquistare il bene di <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">seconda mano</span> (ad esempio, una cucina, o l’auto, un pc, ecc). Al contrario quando vogliamo liberarci di un oggetto possiamo venderlo o <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">regalarlo</span> a qualcuno che ne avrà sicuramente più bisogno di noi.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Lavare a mano i capi in poliestere o altre materie artificiali</h3><p style=\"font-size: 1em;\">Come già detto, la plastica oramai è ovunque. Anche nei nostri vestiti. Quando laviamo in lavatrice i <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">capi sintetici</span> (poliestere) e quando li sottoponiamo a cicli di centrifuga intensi, questi rilasciano nell’acqua delle <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">microplastiche</span> difficilmente filtrabili. Per cui, è sempre meglio lavare a mano e in acqua fredda i capi sintetici (in particolar modo i capi d’abbigliamento sportivo), oppure, quando ciò non è possibile (ad esempio durante i mesi invernali) è bene ridurre al <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">minimo</span> i lavaggi.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Riutilizzare l’acqua</h3><p style=\"font-size: 1em;\">L’acqua è un bene prezioso che va utilizzato con <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">parsimonia</span>. Possiamo riutilizzare l’acqua che viene usata per il lavaggio degli ortaggi e della frutta per annaffiare i nostri fiori e le piante da balcone/giardino.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Non sostare con l’auto accesa</h3><p style=\"font-size: 1em;\">Quando rimaniamo in attesa con il motore acceso, stiamo inquinando inutilmente. Ricordati di spegnere sempre il motore dell’auto o della moto quando sei in sosta, ma soprattutto, se vedi qualcuno stare fermo con il motore accesso, invitalo a spegnere!</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Scelte politiche consapevoli</h3><p style=\"font-size: 1em;\">Purtroppo in Italia manca un vero <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">movimento ecologico</span> ed ambientale. Tuttavia possiamo cambiare le cose scegliendo tra quei partiti che mostrano più <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">consapevolezza</span> ambientale rispetto che altri. Anche e soprattutto a <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">livello locale</span>, prediligiamo quegli amministratori che si mostrano sensibili alle zone pedonali, aree urbane verdi, mantenimento degli alberi e riduzione dell’accesso delle auto nei centri cittadini.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Boicottare</h3><p style=\"font-size: 1em;\">Il boicottaggi è il più <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">potente</span> <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">strumento</span> in mano al consumatore. Quando una determinata società/azienda assume atteggiamenti poco ecologici, semplicemente smettiamo di acquistare i loro prodotti, informando amici e famigliari  e invitando a fare lo stesso.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Prediligere la piccola distribuzione rispetto alla grande</h3><p style=\"font-size: 1em;\">I <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">piccoli commercianti</span> sono una <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">grandissima risorsa</span> per le città, tengono i quartieri puliti, frequentati, pagano le tasse. E’ importante sostenere le loro attività anche perché, generalmente, sono più sostenibili rispetto alla grande distribuzione. I piccoli commerciati, infatti, spesso prediligono prodotti a km 0.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Utilizzare l’aereo il meno possibile</h3><p style=\"font-size: 1em;\">L’aereo produce impressionanti emissioni di CO2. Per questo motivo, si dovrebbero ridurre i viaggi in aereo, prediligendo il <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">treno </span>ogni volta che è possibile.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Usare prodotti naturali ed ecologici per l’igiene personale e la pulizia della casa</h3><p style=\"font-size: 1em;\">I prodotti che noi usiamo per la tenere pulito lo spazio domestico e per l’igiene personale hanno un impatto diretto sull’inquinamento delle falde acquifere. Per questo sarebbe buona abitudine utilizzare sempre prodotti <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">naturali</span>, senza additivi chimici – dannosi sia per noi che per l’ambiente- ed ecologici. Si trovano diversi prodotti in commercio, anche per la pulizia della casa. Tuttavia, se non vogliamo acquistare prodotti specifici, possiamo affidarci a rimedi <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">economici</span> e naturali. <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">L’aceto</span>, ad esempio, è ottimo per pulire la casa: deterge, disinfetta, profuma ed è economico rispetto a tanti altri prodotti.</p></li><li style=\"margin: 0px; font-size: 1rem; font-family: Georgia, serif; line-height: 1.27778rem; padding-top: 0.319444rem; padding-bottom: 0px;\"><h3 style=\"font-size: 1em;\">Ridurre – o eliminare – l’utilizzo di prodotti usa e getta</h3><p style=\"font-size: 1em;\">Come già detto, dobbiamo imparare a consumare meno. Si rende quindi necessario eliminare dalle nostre abitazioni tutti i <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">prodotti usa e getta,</span> e sostituirli con prodotti che possono essere riutilizzati. E’ preferibile usare piatti e stoviglie <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">non</span> di plastica – se proprio dobbiamo, usiamo quelle <span style=\"margin: 0px; font-size: 1em; font-weight: 700;\">compostabili</span> -, panni cattura polvere lavabili in lavatrice, tovaglioli di stoffa e stracci lavabili.</p></li></ul>                ', '2021-08-30', 19, 0, 0, 0),
(10, 6, 'Il lato oscuro della moda: il Fast Fashion', '                                                                                <p class=\"MsoNormal\">Nel 2015, nel Regno Unito, 300mila tonnellate di vestiti\r\nsono finite in discarica. Secondo l’ente di beneficenza britannica Wrap (Waste\r\n& Resources Action Programme) questo numero è diminuito del 14% rispetto al\r\n2012, quando il peso dei capi buttati ammontava a 350mila tonnellate. Come\r\ndire: prima buttavamo un peso equivalente a 58mila elefanti da 6 tonnellate\r\nl’uno. Ora siamo passati a 50mila. È un inizio. Ma il costo ambientale del fast\r\nfashion è ancora alto.<o:p></o:p></p><p class=\"MsoNormal\">Come il simbolico crollo del 2013 dell’industria tessile\r\nRana Plaza in Bangladesh ci ricorda, il costo del fast fashion non è solo\r\nambientale ma anche umano. Da quando, alla fine degli anni 90, la moda si è\r\nfatta rapida ed economica, noi consumatori abbiamo smesso di pagarne il vero\r\nprezzo.<o:p></o:p></p><p class=\"MsoNormal\">Data la complessità e la delicatezza dell’argomento e anche\r\nla pertinenza con la nostra rubrica scientifica, quello di cui parleremo sarà\r\nsolamente la punta di un iceberg grandissimo – composto da fattori economici,\r\nsociali, culturali, ambientali e politici che si intrecciano tra di loro.<o:p></o:p></p><p class=\"MsoNormal\">Un viaggio dalla nascita alla morte dei nostri vestiti,\r\npassando per l’acqua e l’aria che inquinano.<o:p></o:p></p><p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Moda ed\r\neconomia: numeri oltre la passerella<o:p></o:p></span></b></p><p class=\"MsoNormal\">Secondo il database tedesco Statista, nel 1975 in tutto il\r\nmondo sono state prodotte circa 24 milioni di tonnellate di fibre tessili; nel\r\n2019 aveva superato 100 milioni di tonnellate (16 milioni di elefanti). E la\r\ngiustificazione a questo non è da ricercarsi nella crescita demografica: è\r\naumentata anche la produzione pro capite – da 5,9 a 13 chilogrammi a testa\r\nall’anno.<o:p></o:p></p><p class=\"MsoNormal\">Parallelamente è aumentato anche il consumo: l’Agenzia\r\nEuropea dell’Ambiente, in un report del 2014, stima che gli acquisti di\r\nabbigliamento sono aumentati del 40% dal 1996 al 2012. E anche stavolta la\r\ncrescita globale deriva da quella pro capite: +34% a testa nello stesso\r\nperiodo.<o:p></o:p></p><p class=\"MsoNormal\">Paradossalmente, invece, la spesa è diminuita: in Italia,\r\nsempre secondo lo stesso report, la percentuale di spesa totale familiare\r\ndedicata all’abbigliamento è passata da più del 7% a meno del 6%. In Europa,\r\nnel 2012, la percentuale media era pari al 4,2% a famiglia.<o:p></o:p></p><p class=\"MsoNormal\">Quindi: si consuma parecchio di più spendendo un pochino\r\nmeno.<o:p></o:p></p><p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">La regola\r\ndel fast fashion<o:p></o:p></span></b></p><p class=\"MsoNormal\">Purtroppo non si tratta di un paradosso. Questa è la regola\r\ndel fast fashion. Non più due stagioni all’anno – primavera/estate e\r\nautunno/inverno – ma una a settimana per un totale di 52 mini-stagioni. Avere\r\ndavanti gli occhi indumenti sempre nuovi, economici e di tendenza ha portato\r\nnoi consumatori a provare un senso di urgenza nell’acquisto. Compriamo in\r\nmaniera impulsiva e frequente, accumuliamo e possiamo permetterci il lusso di\r\ncambiare outfit ogni giorno.<o:p></o:p></p><p class=\"MsoNormal\">Così abbiamo alimentato il business del fast fashion:\r\naumentare la produzione, velocizzare la manifattura, abbassare la qualità e\r\naccorciare la durata della vita di un indumento. E soprattutto: ridurre il\r\nprezzo spostando la fase produttiva in Paesi in cui la manodopera costa poco.<o:p></o:p></p><p class=\"MsoNormal\">Negli ultimi decenni, in Europa, il costo dell’abbigliamento\r\nha subìto in media un calo del 36% – sfiorando quasi l’80% in Paesi come\r\nl’Irlanda e il Regno Unito.<o:p></o:p></p><p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Il costo\r\nambientale del fast fashion<o:p></o:p></span></b></p><p class=\"MsoNormal\">Le monete con cui il nostro Pianeta paga il conto del fast\r\nfashion sono quattro: acqua, gas serra, sostanze dannose e rifiuti.<o:p></o:p></p><p class=\"MsoNormal\">Ogni fase della vita di un capo d’abbigliamento spende tutte\r\nqueste monete, ma ciascuna lo fa in maniera differente. Produzione e utilizzo\r\nsono, in assoluto, i momenti più costosi.<o:p></o:p></p><p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Acqua e\r\ncampi di cotone<o:p></o:p></span></b></p><p class=\"MsoNormal\">L’industria della moda utilizza grandi quantità di acqua. La\r\nmaggior parte è associata alla coltivazione di cotone. Nel 2018 sono state\r\nprodotti circa 26 milioni di tonnellate di fibre di cotone. Se pensiamo che per\r\nprodurre ogni tonnellata è necessaria una piscina olimpionica e mezza di acqua,\r\nnel solo 2018 di piscine ne sono state utilizzate 39 milioni.<o:p></o:p></p><p class=\"MsoNormal\">Il settore tessile è una delle principali cause di perdita\r\ndi acqua nei Paesi produttori – che in alcuni casi, come Cina e India, sono già\r\nsottoposti a stress idrico. Priva le persone di acqua potabile e ne produce di\r\nsporca: secondo l’organizzazione Pesticide Network Action le coltivazioni di\r\ncotone utilizzano il 6% dei pesticidi globali. Può sembrare poco ma, se\r\nconsideriamo che solo nel 2018, secondo la Fao, sono state usate oltre 4\r\nmilioni di tonnellate di pesticidi in tutti il mondo, il numero che ne deriva è\r\npiuttosto grande.<o:p></o:p></p><p class=\"MsoNormal\">Alternative più pulite esistono, ma non sempre rappresentano\r\nun vantaggio. Il cotone biologico certificato, per esempio, viene coltivato\r\nsenza pesticidi ma richiede maggiori quantità di acqua e la produttività è\r\nminore (fino al 30% in meno). Per ora infatti rappresenta una piccola\r\npercentuale della produzione globale: tra il 2018 e il 2019 ne sono state\r\nprodotte meno di 250mila tonnellate – quindi meno dell’1%.<o:p></o:p></p><p class=\"MsoNormal\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Più diffuso è il Better Cotton: rappresenta la quota\r\nmaggiore di cotone sostenibile, cioè coltivato riducendo al minimo\r\nindispensabile l’utilizzo di pesticidi e di acqua. Nella stagione 2017/18 ne\r\nsono stati prodotte circa cinque milioni di tonnellate. Da qualche anno, alcune\r\norganizzazioni hanno dato il via a una classifica, la Sustainable Cotton\r\nRanking, per incentivare la conversione a pratiche più sostenibili: al momento\r\nin testa, col punteggio più alto, si trova la Adidas.<o:p></o:p></p>                                                                ', '2021-08-30', 19, 1, 0, 0),
(11, 2, 'L\'arte cinese di avvolgere il cibo', '<p class=\"MsoNormal\">La cucina cinese è un mondo molto complesso e variegato. La\r\nvastità del Paese si riflette nella ricchezza e nella molteplicità di piatti,\r\ningredienti e sapori. Ogni regione è caratterizzata da pietanze e gusti\r\nparticolari, molto diversi tra loro. Ma è possibile rintracciare al suo interno\r\ndei concetti guida che permettono di scoprirla considerando particolari punti\r\ndi vista. Uno di questi è il concetto di bao “avvolgere, incartare”. Nella\r\ncucina cinese, tra i piatti più conosciuti, infatti, molti si ricollegano\r\nproprio a questo “abbraccio culinario”.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Baozi<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">È sicuramente l’abbraccio più rappresentativo della\r\ngastronomia cinese. Già nel nome troviamo la parola bao, filo conduttore di\r\nquesto viaggio culinario. I Baozi sono una sorta di pane ripieno di carne o\r\nverdure, cotto al vapore. Possono essere considerati il re degli snack, visto\r\nche sono mangiati con assiduità un po’ ovunque in Cina. Sono uno spuntino\r\nadorato dai cinesi, che non disdegnano una sosta in una tavola calda o in un\r\nconvenience store, ormai diffusissimi in tutte le grandi città del Paese, per regalarsi\r\nquesto semplice e delizioso panino, gustandolo il più delle volte per strada,\r\nin qualsiasi ora della giornata.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Ravioli<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">Tra i piatti più ordinati dagli italiani nei ristoranti\r\ncinesi, si sono sviluppati nel Nord della Cina. Sono consumati tradizionalmente\r\nnelle occasioni speciali. Un’usanza che si fa risalire alla Dinastia Ming\r\n(1368–1644). Alla griglia o al vapore, quindi, i ravioli vengono mangiati\r\ndurante le feste, a partire dalla Festa di Primavera, che segna l’inizio\r\ndell’anno lunare. Perciò non sono affatto un semplice spuntino che funge, come\r\nerroneamente crediamo in Occidente, da “apri pancia”, bensì un cibo rituale,\r\ncollegato a ricorrenze fauste. La tradizione vuole che tutta la famiglia\r\npartecipi alla loro preparazione, dalla lavorazione dell’impasto, sino alla\r\ncottura, per poi consumarli con gioia e immancabile chiasso su un grande\r\ntavolo, preferibilmente circolare. Altro che “antipasto”, i ravioli sono un\r\nrito. Ed è proprio nei ravioli che il termine bao trova il suo significato più\r\ncompleto, poiché quell’avvolgere altro non è che il riportare insieme le cose,\r\nl’universo nella visione taoista, la società e la famiglia in quella\r\nconfuciana. In entrambi i casi si ricompone un qualcosa di prezioso, il cui\r\ninterno o condimento può essere interpretato filosoficamente quale un’armonia\r\ndell’unione. Una volta racchiuso, il significato può essere finalmente compreso\r\ne, continuando questa metafora filosofico-culinaria, consumato.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Crêpes\r\nalla Mandarina<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">Molto apprezzate anche in Occidente, sono uno dei classici\r\ndella cosiddetta cucina imperiale, indispensabile accompagnamento della\r\nceleberrima Anatra laccata. Le crêpes sono una variante delle Crespelle Foglie\r\ndi Loto, tipico contorno della cucina del Nord, che può essere servito sia come\r\naccompagnamento a piatti di carne o pesce, sia da solo, guarnito con salse e\r\nverdure.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Involtini\r\nPrimavera<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">Sono senza dubbio tra le più amate pietanze “avvolte” cinesi\r\nin Italia. Ogni regione della Cina ha la propria ricetta, che ne varia il\r\ncontenuto, ma non la forma. In genere il ripieno segue anche la stagionalità\r\ndegli ingredienti e solitamente è costituito da carne, pesce e vari tipi di\r\nverdura.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Involtini\r\ndi Tofu<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">Meno noti degli Involtini Primavera, soprattutto perché il\r\ntofu non è un ingrediente molto popolare tra gli italiani, ne costituiscono\r\nperò un’ottima alternativa. Spesso avvolti da una foglia di cavolo bianco, sono\r\nun piccolo e salutare sfizio per il palato.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Wonton<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">Meno noti con il nome in cinese mandarino Huntun, sono dei\r\npiccoli involucri di pasta a forma di sacchetto, simili ai più conosciuti\r\nravioli, benché ad alcuni palati raffinati possano sembrare delle caramelle\r\nancora incartate. Ciascuna regione ha il suo modo di farcirli e solitamente\r\nvengono consumati in brodo. Come per gli Involtini di Tofu, anche i Wonton non\r\nsono nella lista delle preferenze dei clienti occidentali.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><b><span style=\"font-size:14.0pt;line-height:107%\">Dim Sum<o:p></o:p></span></b></p>\r\n\r\n<p class=\"MsoNormal\">Sono l’anima pulsante dei ristoranti del Guandong e della\r\ncucina cantonese. I Dim Sum, in mandarino dianxin, sono dei deliziosi snack,\r\nstoricamente legati alle case da tè e le loro varietà, riprendendo un detto\r\nutilizzato a proposito dei vari stili di kung fu, sono tante quante le stelle\r\nnel cielo. Si consumano nei ristoranti solo a pranzo o come spuntino\r\npomeridiano, mai a cena. Tra questi, ottimi sono i Cha siu bao, cha shao bao in\r\nmandarino, conditi con carne di maiale e cotti al vapore o al forno. Se si fa\r\ntappa a Hong Kong, sarà facile venire letteralmente rapiti da questi spuntini.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>', '2021-08-30', 21, 1, 1, 5),
(12, 8, 'Intelligenza artificiale e buisness', '<div>Per il mondo del retail l’intelligenza artificiale non è una novità dell’ultima ora. Dagli assistenti virtuali ai software per analisi predittive, fino ai recenti sviluppi della realtà aumentata, la tecnologia consente di ricreare a favore del cliente online l’emozione e il calore dell’acquisto in negozio. Tanto che, complice l’avvicinamento al canale online da parte di nuove fasce di utenti, la proposta commerciale diventa sempre più ibrida.</div><div>Secondo stime di Tractica (società di market intelligence), nel 2025 i ricavi generati dall’intelligenza artificiale arriveranno a superare i 30 miliardi di dollari, 60 volte in più rispetto al 2016. Anche l’Italia è destinata a registrare una crescita importante rispetto ai 200 milioni di valore attuale tra software, hardware e servizi. Con il retail che sarà tra i comparti più impattati dalla nuova frontiera, grazie alla possibilità di estrarre dati dai clienti, semplificare la gestione delle forniture, effettuare analisi predittive, ottimizzare la gestione del magazzino e della logistica, automatizzare i veicoli nei centri di distribuzione.</div><div><h5>I principali ambiti di applicazione</h5><div>Quando si parla di Intelligenza artificiale si pensa a qualcosa di molto distante dalla vita quotidiana e dalle attività del tempo libero, ricorda Gianluca Maruzzella, co-founder &amp; ceo di Indigo.ai, piattaforma di conversational AI per progettare e costruire assistenti virtuali, tecnologie di linguaggio ed esperienze conversazionali. “Ci sono invece diverse applicazioni che non solo ci possono aiutare, ma anche allietare nella vita di tutti i giorni, o che operano in settori inaspettati, come il musicale o l’artistico”, sottolinea l’esperto. Che cita alcuni esempi in proposito? “Siete fan di un cantante del passato, di un gruppo che si è sciolto? L’intelligenza artificiale può incidere i loro nuovi album”. Una conferma in tal senso arriva da Over The Bridge, organizzazione canadese che tramite l’algoritmo ha “resuscitato”, quattro artisti scomparsi giovani: Amy Winehouse, Kurt Cobain, Jimi Hendrix e Jim Morrison. Il software di Google, Magenta Ai, all’interno dell’iniziativa Lost Tapes of 27 Club ha inciso dei brani musicali che, pur dichiaratamente falsi d’autore, per le loro caratteristiche potrebbero essere attribuiti agli artisti morti prematuramente.</div><div><h5>I robot ballerini</h5><div>Maruzzella cita anche il caso di Boston Dynamics, che per augurare buon anno ai suoi clienti, lo scorso 31 dicembre ha diffuso un video virale in cui i suoi robot umanoidi si scatenavano in un ballo al ritmo di “Do you love me?” dei The Contours con protagonisti quattro robot più che agili. La danza è avviata da “Atlas”, il robot umanoide nella sua ultima versione, più agile e leggero. È definito dall’azienda “una piattaforma di ricerca progettata per superare i limiti della mobilità del suo corpo”. Non commercializzato, Atlas è usato per capire quanto si può spingere la robotica in termini di mobilità.</div><h5><br><b>Il consulente digitale per la bellezza</b></h5><div>L’intelligenza artificiale si occupa anche di skincare. Le app di intelligenza artificiale possono ad esempio definire le sfumature della pelle e la forma delle sopracciglia che più si adattano alla forma del viso del cliente, consentendo così una personalizzazione del servizio ben superiore rispetto ai canoni tradizionali.</div><div>Dopo aver ‘insegnato’ all’algoritmo cosa riconoscere dal punto di vista dermatologico, ricorda il co-founder &amp; ceo di Indigo.ai, un Bot guidato da un’intelligenza artificiale potrà aiutare gli utenti – attraverso una app – a riconoscere velocemente i problemi della pelle indirizzandoli verso le giuste soluzioni o suggerendo un consulto con uno specialista. “Ma potrebbe anche consigliare una migliore routine per la cura della pelle (e della bellezza) e memorizzare la storia dermatologica della persona, così che l’utente abbia sempre sotto controllo il quadro generale della propria pelle”, aggiunge.</div></div></div>', '2021-08-30', 22, 0, 0, 0),
(14, 8, 'Viaggio a piedi: cosa sapere prima di partire', '<h4 style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; font-size: 20px; color: rgb(68, 68, 68); font-family: Georgia, serif;\"><span style=\"box-sizing: inherit; font-weight: bolder;\">Il viaggio a piedi è una scelta di vita: significa decidere di dedicare del tempo a se stessi e a ciò che ci circonda</span><span style=\"box-sizing: inherit;\">.</span></h4><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">E’ una scelta sicuramente non facile, ma se da una parte ci sono tutte le difficoltà del caso, dall’altra la ricompensa sarà maggiore: arrivare con le tue gambe dove ti sei prefissato, tramite&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">un percorso di crescita fisico e mentale</span><span style=\"box-sizing: inherit;\">. Un percorso che ti farà entrare in contatto con le culture dei Paesi che stai attraversando, strada per strada, quartiere per quartiere, non relegandoti ai soli posti turistici che un viaggio tradizionale ti imporrebbe.</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><i style=\"box-sizing: inherit;\">Nella quotidianità siamo legati ad una routine ben collaudata e relativamente poco flessibile, fatta di luoghi da raggiungere a causa di necessità da soddisfare in orari da rispettare che depenna i giorni dal calendario sfuggendo al nostro controllo.</i></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit; font-weight: bolder;\">Evitare di continuare questa abitudine anche in vacanza spinge molte persone a intraprendere un viaggio a piedi.</span><span style=\"box-sizing: inherit;\">&nbsp;In questo tipo di avventura la routine sarà ‘semplicemente’ relegata all’atto della sveglia (che, preparati, potrà essere anche prima di quella che punti per andare al lavoro!) e al mettersi in marcia.</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Spesso si sente dire che il primo passo è il più difficile, poi sarà tutto in divenire, ed è vero: i muscoli delle gambe cominceranno ad allenarsi, i calli sotto ai piedi si induriranno e la testa si svuoterà dei pensieri. A questo proposito, nel caso non lo sapessi,&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">camminare così come fare sport in generale aumenta l’endorfina</span><span style=\"box-sizing: inherit;\">, una sostanza organica prodotta dal cervello che ci provoca piacere.</span></p><h4 style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; font-size: 20px; color: rgb(68, 68, 68); font-family: Georgia, serif;\"><span style=\"box-sizing: inherit;\">L\'allenamento è tutto!</span></h4><h5 style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; font-weight: var(--font_titles-font-weight); line-height: 1.25; font-size: 42px; font-family: var(--font_titles-font-family); color: rgb(68, 68, 68);\"><i style=\"box-sizing: inherit; font-family: Georgia, serif; font-size: 20px;\">A proposito di fisico, com’è andata questa prima salita? Sento che hai il fiato un po’ corto, cosa ne dici se rallentiamo un po’ l’andatura così da regolarizzare la respirazione, mentre parliamo un po’ della preparazione?</i><br></h5><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Eccoci alla&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">parte più lunga e seria</span><span style=\"box-sizing: inherit;\">, fino ad ora hai fantasticato sulle mete, immaginato romantiche notti al chiaro di luna in mezzo al nulla, ma non dimenticarti che stai partendo per un viaggio a piedi che vuol dire prima di tutto un gran bello sforzo fisico.</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Ora pensaci un attimo, quand’è l’ultima volta che hai camminato per qualche ora con uno zaino sulle spalle? Bene, ora pensa che dovrai farlo tutto il giorno, per diversi giorni, con probabilmente uno zaino più pesante! Quindi è fondamentale allenarsi, provare con qualche camminata minore, da poche ore a qualche giorno, andando a testare i propri limiti.</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Ehi, non scappare!&nbsp;</span><i style=\"box-sizing: inherit;\">Lasciati accompagnare ancora oltre questo passo e vedrai che poi sarà più semplice!</i></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Quindi&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">come ci si prepara</span><span style=\"box-sizing: inherit;\">&nbsp;per un viaggio a piedi ?</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Qualcuno a questo punto potrebbe dirti che l’obiettivo ti sei posto è troppo ambizioso, che non sei abbastanza allenato o che là non è poi come qua.. bè a parte che queste parole potrebbero sortire l’effetto opposto e alimentare la tua voglia di arrivare in fondo alla sfida per dimostrare il tuo valore, ti dico anche che</span><span style=\"box-sizing: inherit; font-weight: bolder;\">&nbsp;se la tua volontà è forte non ci saranno problemi</span><span style=\"box-sizing: inherit;\">. Se al momento ti senti fuori forma avrai bisogno di una preparazione più lunga, ma questo non sarà un ostacolo,&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">la vita è un susseguirsi di obiettivi, questo è semplicemente il prossimo!</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Banalmente si &nbsp;potrebbe affermare che la preparazione sta tutta nell’essere in grado di sopportare qualche chilo sulle spalle per qualche chilometro, nulla che adesso ti possa sembrare impossibile, ma quando i chili arrivano ad una decina e i chilometri a qualche centinaio per più giorni consecutivi, allora si che la cosa sarà meno banale.</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">In genere le prime avvisaglie di malessere colpiscono i piedi e le articolazioni delle ginocchia, anche una sola giornata di cammino con scarpe sbagliate o il peso nello zaino mal distribuito (ricorda: sempre&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">le cose pesanti in fondo!</span><span style=\"box-sizing: inherit;\">) possono portare problemi che ti perseguiteranno per giorni mettendoti a dura prova!</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Poi sarà la volta delle spalle e della schiena: per quanto a casa ti possa sembrare ininfluente,&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">ogni grammo che riuscirai ad evitare</span><span style=\"box-sizing: inherit;\">, sarà sollievo lungo la camminata. In base a questi punti è bene da subito essere onesti con se stessi e fare un po’ di allenamento in base alle tue condizioni e all’obiettivo, aumentando di volta in volta carico e distanza.</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Utile durante questo periodo può essere riempire lo zaino con delle bottiglie d’acqua per avere bene idea del peso che si porta e, nel caso si sia esagerato, si possono svuotare a metà percorso!</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\">Infine però sappi che&nbsp;</span><span style=\"box-sizing: inherit; font-weight: bolder;\">il miglior allenamento lo dà il viaggio stesso…</span><span style=\"box-sizing: inherit;\">dopo i primi giorni a ritmi un po’ più blandi sarai meravigliato di come si risveglierà il tuo corpo e quante soddisfazioni ti regalerà: in fondo il viaggio a piedi è anche una scoperta di se stessi no?!</span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><span style=\"box-sizing: inherit;\"></span></p><p style=\"box-sizing: inherit; margin-top: 30px; margin-bottom: 30px; color: rgb(68, 68, 68); font-family: Georgia, serif; font-size: 20px;\"><i style=\"box-sizing: inherit;\">Eccoci così arrivati al passo, abbiamo riscaldato i muscoli e rotto il fiato, la meta è ancora lontana ma ormai ci siamo incamminati e ti stai muovendo più agilmente.</i></p>', '2021-08-30', 23, 1, 1, 3);
INSERT INTO `articolo` (`codiceArticolo`, `autore`, `titolo`, `testo`, `dataScrittura`, `blog`, `numeroCommenti`, `numeroVoti`, `mediaVoti`) VALUES
(15, 9, 'La public history e ilmuseo', '                    <p class=\"MsoNormal\">“Senza utopia non si fa la realtà!”. Sembra lo slogan\r\npubblicitario di una multinazionale passato alla televisione negli anni\r\nSessanta. E invece con grandissimo entusiasmo lo gridava Franco Russoli, ex\r\ndirettore della Pinacoteca di Brera. Perché il direttore di uno dei musei più\r\nimportanti d’Italia, definito il piccolo Louvre, sentiva la necessità di\r\ncambiare ciò che è stato costruito con fatica e che rispetta le aspettative\r\ntradizionali dei pubblici che lo frequentano?</p>\r\n\r\n<p class=\"MsoNormal\">Giorgio Agamben, una volta, al bar con degli amici, e poi in\r\nuno dei testi più brillanti mai scritti, “Che cos’è il contemporaneo?”, scrisse\r\nche “contemporaneo è l’inattuale”. E cioè colui che sa vedere “come un male, un\r\ninconveniente, un difetto, qualcosa di cui la sua epoca va giustamente\r\norgogliosa”. Il contemporaneo è “una singolare relazione col proprio tempo, che\r\naderisce a esso e, insieme, ne prende le distanze”. È un’abilità che equivale a\r\n“neutralizzare le luci che provengono dall’epoca per scoprire la sua tenebra,\r\nil suo buio speciale”. Bene, Franco Russoli era una rarità nel panorama\r\nintellettuale di quegli anni. E aveva ben intuito che il museo non poteva solo\r\nessere un contenitore di memorie passate. E che per nessun motivo la sua\r\nfunzione doveva risolversi con la mera muta esposizione.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Questo intellettuale ha lavorato tutta la sua vita affinché\r\nquella memoria fosse interpellata, decostruita e ricomposta, non solo dagli\r\naddetti ai lavori, ma da chiunque volesse riscoprire la propria relazione con il\r\ntempo e la cultura. Insomma, il museo doveva diventare un luogo di possibilità,\r\nuno spazio vivo, volto all’alimentazione del pensiero critico di ognuno. Quando\r\noggi aspettiamo ansiosi il prossimo Decreto, e ci accorgiamo che va bene aprire\r\nuna chiesa ma non aprire un museo, assistiamo al crollo delle utopie dei\r\nvirtuosi esempi del nostro passato. Davvero i musei sono considerati meno di un\r\ncentro commerciale? Eppure, se decidessimo domani di andare alla Rinascente ed\r\nentrare da Alessi, i prodotti che vi troveremmo esposti, in parte sono stati\r\nselezionati e esposti all’interno di un Museo del Design.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Questo è uno strumento a cui bisogna aggrapparsi in un\r\nperiodo di perdizione critica, e che può aiutarci a resistere al delirio di\r\nonnipotenza a cui assistiamo quotidianamente da parte di chi, esprimendolo alla\r\nmaniera di Agamben, non è contemporaneo e ignora le conseguenze di questa\r\nchiusura culturale o forse le programma. La public history aiuta a mantenerci\r\nin allenamento rispetto alla presa di coscienza dei prodotti che bulimicamente\r\nsta producendo questa società. Bisogna ricordare che in questo momento storico\r\nnon si può assolutamente rallentare rispetto allo studio dei fenomeni e dei\r\ncontenuti che si producono. Perché sono il collegamento alla prossima epoca.\r\nIgnorare il fatto che la ricerca deve avvalersi dei luoghi della cultura, per\r\nanticipare il prossimo futuro, è un attentato all’emancipazione culturale.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><br></p>\r\n\r\n<p class=\"MsoNormal\">Dovremmo arrivare preparati alle richieste di ciò che ci\r\naspetta. Chiudere le istituzioni culturali significa rallentare una serie di\r\nmeccanismi che già con gran fatica tentano di cristallizzarsi nel mondo\r\naccademico. Questo blocco fa pensare lontanamente al saccheggio della\r\nBiblioteca di Alessandria. Si sente più che mai la necessità di riappropriarsi dell’idea\r\nche non esistono gerarchie sociali all’interno delle quali c’è una fascia più\r\nbassa e una più alta. Siamo tutti testimoni e autori di questa crescita.\r\nChiunque ha la giusta sensibilità per avere un’idea, ed è fondamentale\r\ninvestire sulle relazioni all’interno dei luoghi della cultura e soprattutto\r\nsulle discipline sperimentali, come la Public History, che è uno strumento di\r\nappropriazione culturale orientata al futuro.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>                ', '2021-08-30', 24, 2, 1, 4),
(16, 2, 'Intelligenza Artificiale e Digital Marketing: come difendersi dai bias', '<p class=\"MsoNormal\">L’Intelligenza Artificiale (AI), o meglio il Machine\r\nLearning (ML), sono sempre più importanti nel Marketing Digitale perché\r\npermettono ai marketer di ottenere insight rilevanti dagli innumerevoli dati\r\ngenerati dalle diverse attività aziendali. Il ruolo principale di queste\r\ntecnologie è infatti quello di fornire informazioni sui clienti e sul business.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\">Uno scambio estremamente vantaggioso che si basa su un\r\nvalore imprescindibile: la fiducia nell’AI. Per affidarsi totalmente a questa\r\ntecnologia, marketer e inserzionisti devono dunque essere consapevoli\r\ndell’esistenza dei bias algoritmici – un termine tecnico che denota un errore\r\ndovuto da assunzioni sbagliate nel processo di apprendimento automatico. Tali\r\n“distorsioni” potrebbero effettivamente influenzare il corretto raggiungimento\r\ndell’audience di riferimento, ma grazie ad una AI responsabile possono essere\r\nlimitate. Prima di capire come “correggere” il bias, vediamo alcuni esempi di\r\n“incidenti con l’AI” che possono verificarsi.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Tra i casi più pericolosi troviamo sicuramente il cosiddetto\r\n“data poisoning”, ossia un inquinamento dei dati compiuto volontariamente da\r\nhacker esperti in iIntelligenza Artificiale. Per citarne uno, nel 2016, il\r\nchatbot di una piattaforma social media venne ingannato ed educato ad un\r\nlinguaggio negativo che lo rese inevitabilmente razzista e offensivo.\r\n“Partnership on AI” cura un database che presenta più di 1200 report pubblici\r\ncon incidenti AI simili a quelli appena descritto. Inoltre negli ultimi anni sono\r\nsempre più oggetto di grande attenzione anche da parte di media e giornalisti.\r\nEcco perché i brand dovrebbero prevenirli ed evitare quindi una crisi\r\nreputazionale ben prima che accada.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Tra gli incidenti più comuni primeggia invece la cosiddetta\r\ndiscriminazione algoritmica che si presenta quando AI e ML non presentano il\r\nmessaggio giusto ad uno specifico gruppo demografico. Per i marketer e gli\r\ninserzionisti avere dei bias potrebbe quindi significare non raggiungere la\r\ngiusta audience e di conseguenza perdere potenziali opportunità di vendita.\r\nDiventa necessario comprendere ed educare al meglio l’Intelligenza Artificiale\r\na cui si decide di affidare non solo le proprie campagne adv, ma anche e\r\nsoprattutto il budget aziendale e i relativi profitti del brand.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Nel binomio Intelligenza Artificiale e Digital Marketing un\r\naltro errore che potrebbe coinvolgere i sistemi di AI è la mancanza di\r\ntrasparenza e di responsabilità, come successo a Google alcuni anni fa. Il\r\nmotore di ricerca più usato al mondo suggeriva agli utenti risultati offensivi\r\ne privi di senso che in pochissimo tempo hanno fatto il giro del mondo. In\r\nrisposta, l’azienda ha subito inserito una feature per segnalare i risultati\r\ninappropriati. Adottando questa pratica è stato possibile fornire direttamente\r\nai consumatori la possibilità di inviare un feedback, comunicando che il\r\nrisultato ottenuto ed elaborato dal sistema è errato, in questo modo si\r\nsupporta contemporaneamente l’apprendimento dell’algoritmo stesso.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">In Quantcast, abbiamo recentemente lanciato sul mercato una\r\npiattaforma proprietaria di audience intelligence alimentata da Ara™, un motore\r\ndi AI e Machine Learning brevettato dell’azienda che viene costantemente\r\nsottoposto a diversi processi quali rigorosi controlli accademici e peer review\r\ncondotti da esperti di Machine Learning altamente qualificati. Una scrupolosità\r\ne un’attenzione maniacale volti proprio ad evitare o almeno ridurre al massimo\r\ni bias.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Alla responsabilità bisogna però associare anche la\r\ntrasparenza che rende l’AI interpretabile e spiegabile: ciò consente una\r\ncomprensione e revisione umana oltre ad un maggior controllo. Ogni azienda\r\ndovrebbe, quindi, tenere traccia di tutti i sistemi AI, esaminandoli ed\r\nassicurandosi che funzionino correttamente. Sono di fondamentale importanza\r\nanche misure di sicurezza informatica di base come ad esempio programmi basati\r\nsu ricompense per la segnalazione di bug, in gergo “bug bounty”, e verifiche\r\nattraverso test effettuati da esperti del settore. Inoltre potrebbe rivelarsi\r\nutile anche documentare i sistemi di AI e ML adottati creando un manuale per la\r\nrisoluzione di eventuali problemi e incidenti che potrebbero verificarsi,\r\npermettendo così una risoluzione tempestiva.<o:p></o:p></p>', '2021-08-30', 20, 0, 0, 0),
(17, 6, 'Alimentazione da sportivi', '<p class=\"MsoNormal\">Quanto è Importante Alimentarsi Correttamente?<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">La regola principale è molto semplice: non esistono alimenti\r\nche possono far vincere una gara, ma esistono molti alimenti che possono farla\r\nperdere.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Partendo da questo assunto è necessario crearsi una\r\nconsapevolezza alimentare, e prendere confidenza con pochi concetti generali\r\nche è utile conoscere per impostare una corretta alimentazione, in relazione\r\nagli sforzi fisici da sostenere.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Dobbiamo innanzitutto ricordare che tutto ciò che\r\nintroduciamo nel nostro organismo, deve servire contemporaneamente:<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Come benzina (le calorie),<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Come protezione (vitamine, minerali, fibre, antiossidanti),<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Per la regolazione termica (l\'acqua delle bevandee quella\r\ncontenuta nei cibi),<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Per la continua manutenzione dei pezzi usurati (le\r\nproteinecon i loro aminoacidi essenziali che permettono il continuo\r\nrinnovamento dei tessuti).<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Di Quali Macronutrienti ha bisogno l’Essere Umano?<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">https://www.my-personaltrainer.it/imgs/2020/10/23/alimentazione-corretta-dello-sportivo-orig.jpegShutterstock<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">I giornali e la televisione parlano spesso di diete e di\r\nalimentazione; se ne parla molto anche&nbsp;\r\nin ambiente sportivo. Tuttavia, per un motivo o per un altro, non tutti\r\nhanno le idee chiare e spesso si tramandano vecchie nozioni popolari non\r\ncondivise dalla scienza moderna.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\">Il motore umano ha bisogno di una miscela di macronutrienti\r\n(carboidrati, proteine, grassi) con dei rapporti percentuali preferenziali per\r\nfunzionare al meglio.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Allora, precisiamo subito quale debba essere la miscela più\r\nopportuna per qualsiasi essere umano (sedentario o sportivo non fa poi molta\r\ndifferenza, se non per la minore o maggiore quantità di miscela, mentre la sua\r\ncomposizione percentuale è simile).<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class=\"MsoNormal\">Almeno il 50-60% delle calorie che occorrono a ciascuno di\r\nnoi deve provenire dal gruppo dei carboidrati, non più del 30% dal gruppo dei\r\ngrassi ed il restante 10-20% dal gruppo delle proteine.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Dato che il motore umano è molto complesso, necessita anche\r\nelementi \"protettivi\" (vitamine, minerali, ecc.).<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Uno degli effetti dell\'allenamento è l\'aumento del tessuto\r\nmuscolare; ma se aumenta la quantità di tessuto muscolare, aumenta il\r\nmetabolismo.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">I muscoli degli atleti consumano una miscela di carboidrati\r\ne lipidi&nbsp; che varia in percentuale a\r\nseconda degli allenamenti effettuati e dell\'intensità dell\'esercizio fisico:\r\nall\'inizio dell\'esercizio vengono consumati carboidrati, nell\'esercizio\r\nprettamente aerobico i muscoli utilizzano soprattutto i grassi, mentre con il\r\ncrescere dell\'intensità del lavoro viene consumata una miscela sempre più ricca\r\ndi carboidrati.<o:p></o:p></p>', '2021-08-30', 25, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `blog`
--

CREATE TABLE `blog` (
  `codiceBlog` int(11) NOT NULL,
  `nomeBlog` varchar(50) NOT NULL,
  `autore` int(11) NOT NULL,
  `descrizione` varchar(1500) NOT NULL,
  `posizioneImgProfilo` text DEFAULT NULL,
  `posizioneImgCopertina` text DEFAULT NULL,
  `numeroSeguaci` int(11) NOT NULL DEFAULT 0 CHECK (`numeroSeguaci` >= 0),
  `numeroPost` int(11) NOT NULL DEFAULT 0 CHECK (`numeroPost` >= 0),
  `numeroArticoli` int(11) NOT NULL DEFAULT 0 CHECK (`numeroArticoli` >= 0),
  `graficaBlog` tinyint(4) NOT NULL DEFAULT 1,
  `numeroCollaboratori` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `blog`
--

INSERT INTO `blog` (`codiceBlog`, `nomeBlog`, `autore`, `descrizione`, `posizioneImgProfilo`, `posizioneImgCopertina`, `numeroSeguaci`, `numeroPost`, `numeroArticoli`, `graficaBlog`, `numeroCollaboratori`) VALUES
(19, 'Il cambiamento climatico', 6, 'Il concetto di cambiamento climatico implica fattori politici, giuridici, etici, economici e scientifici, andando ben oltre il significato associato alle variazioni naturali del clima, che si sono succedute sulla superficie terrestre nel corso del tempo geologico.\r\nOgnuno di noi dovrebbe prestare maggiore attenzione a quello che produce ogni giorno. Il nostro pianeta è esausto.', 'uploads/612cd00f36bb25.69987413.jpg', 'uploads/612cd00f381e53.82696382.jpg', 0, 2, 2, 3, 0),
(20, 'Blog di informatica', 2, 'Il blog cerca di tenervi sempre aggiornati con le novità in campo informatico!\r\n', 'uploads/612cdc9b3ae6a0.81811848.jpg', 'uploads/612cdc9b3b5a31.68067743.png', 0, 2, 1, 2, 0),
(21, 'La cucina cinese', 2, 'Ricette facili e veloci per avvicinarsi alla cucina cinese!', 'uploads/612cdf6de6ae53.88010764.jpg', 'uploads/612cdf6de6c892.40423406.jpg', 2, 4, 1, 1, 0),
(22, 'I progressi dell\'intelligenza artificiale', 8, 'I progressi dell\'intelligenza artificiale nel secolo in cui viviamo! Siamo in continuo aggiornamento', 'uploads/612ce3282753c3.37872665.jpg', 'assets\\img\\coverDefault.jpg', 1, 1, 1, 3, 0),
(23, 'Il mio viaggio in Thailandia', 8, 'In questo blog descriverò il mio viaggio a piedi per la Thailandia! Stay tuned', 'uploads/612cebc859f2b4.35315907.jpg', 'assets\\img\\coverDefault.jpg', 0, 1, 1, 1, 0),
(24, 'L\'informatica umanistica', 9, 'Cos\'è l\'informatica umanistica? \r\nLeggi i seguenti contenuti per scoprirlo, non te ne pentirai!', 'assets\\img\\default.jpg', 'uploads/612cf06a67e072.36497939.jpg', 0, 1, 1, 3, 0),
(25, 'Dalla palestra alla cucina', 6, 'Sei un amante dello sport e del fitness? Questo blog fa al caso tuo!', 'uploads/612cf3a4869ae3.10062769.jpg', 'uploads/612cf3a486c299.87622258.jpg', 0, 1, 1, 1, 0),
(26, 'test', 9, 'test', 'assets\\img\\default.jpg', 'assets\\img\\coverDefault.jpg', 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `caratterizzazionearticolo`
--

CREATE TABLE `caratterizzazionearticolo` (
  `articolo` int(11) NOT NULL,
  `tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `caratterizzazionearticolo`
--

INSERT INTO `caratterizzazionearticolo` (`articolo`, `tag`) VALUES
(9, 10),
(9, 11),
(9, 12),
(10, 13),
(10, 14),
(10, 15),
(11, 16),
(11, 17),
(11, 18),
(11, 19),
(12, 20),
(12, 21),
(12, 22),
(14, 24),
(14, 26),
(14, 27),
(14, 28),
(15, 29),
(15, 30),
(15, 31),
(15, 32),
(16, 33),
(16, 34),
(17, 35),
(17, 36),
(17, 37);

-- --------------------------------------------------------

--
-- Struttura della tabella `collaborazione`
--

CREATE TABLE `collaborazione` (
  `utente` int(11) NOT NULL,
  `blog` int(11) NOT NULL,
  `dataInizio` date NOT NULL,
  `dataFine` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `collaborazione`
--

INSERT INTO `collaborazione` (`utente`, `blog`, `dataInizio`, `dataFine`) VALUES
(2, 22, '2021-08-30', NULL),
(6, 22, '2021-08-30', '2021-08-30');

-- --------------------------------------------------------

--
-- Struttura della tabella `commentoarticolo`
--

CREATE TABLE `commentoarticolo` (
  `codiceCommento` int(11) NOT NULL,
  `autore` int(11) DEFAULT NULL,
  `articolo` int(11) NOT NULL,
  `testo` varchar(2500) NOT NULL,
  `dataOra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `commentoarticolo`
--

INSERT INTO `commentoarticolo` (`codiceCommento`, `autore`, `articolo`, `testo`, `dataOra`) VALUES
(10, 6, 10, 'Fatemi sapere cosa ne pensate!', '2021-08-30 12:39:32'),
(12, 2, 15, 'Finalmente qualcuno parla di public history! Il mondo sta cambiando!!!', '2021-08-30 17:02:21'),
(13, 10, 14, 'Interessante... Ma perchè non parlare anche dell\'attrezzatura necessaria?', '2021-08-30 17:10:58'),
(14, 10, 15, 'Quanti informatici umanistici come noi?', '2021-08-30 17:11:16'),
(19, 9, 11, 'Interessante!', '2021-08-30 18:13:39');

-- --------------------------------------------------------

--
-- Struttura della tabella `commentopost`
--

CREATE TABLE `commentopost` (
  `codiceCommento` int(11) NOT NULL,
  `autore` int(11) DEFAULT NULL,
  `post` int(11) NOT NULL,
  `testo` varchar(2500) NOT NULL,
  `dataOra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `commentopost`
--

INSERT INTO `commentopost` (`codiceCommento`, `autore`, `post`, `testo`, `dataOra`) VALUES
(93, 2, 42, 'In bocca al lupo!', '2021-08-30 17:01:41'),
(94, 2, 43, 'Interessante!\n', '2021-08-30 17:02:00'),
(95, 10, 41, 'Sembrano buonissimi!\n', '2021-08-30 17:12:17'),
(96, 10, 39, 'Adoro il tuo blog!\n', '2021-08-30 17:12:28');

-- --------------------------------------------------------

--
-- Struttura della tabella `contenuto`
--

CREATE TABLE `contenuto` (
  `codiceContenuto` int(11) NOT NULL,
  `posizioneContenuto` text NOT NULL,
  `tipoContenuto` enum('immagine','video','audio','link') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `contenuto`
--

INSERT INTO `contenuto` (`codiceContenuto`, `posizioneContenuto`, `tipoContenuto`) VALUES
(29, 'uploads/eAnF143119.jpg', 'immagine'),
(30, 'uploads/bBAf143337.png', 'immagine'),
(39, 'uploads/GmQd152453.jpg', 'immagine'),
(40, 'uploads/LZMs152612.jpg', 'immagine'),
(41, 'https://altreconomia.it/le-conseguenze-dei-cambiamenti-climatici-sui-bambini/', 'link'),
(42, 'uploads/pQyq152743.jpg', 'immagine'),
(43, 'https://www.smartworld.it/informatica/microsoft-aggiorna-requisiti-aggiornare-windows-11-tutti-dettagli.html', 'link'),
(44, 'uploads/NCpF152843.mp3', 'audio'),
(45, 'uploads/iNKI154140.jpg', 'immagine'),
(46, 'uploads/EZHy154545.jpg', 'immagine'),
(47, 'uploads/BIpz154833.mp4', 'video'),
(48, 'uploads/kNKX154950.jpg', 'immagine'),
(49, 'https://speciali.cookaround.com/cucina-cinese', 'link'),
(50, 'uploads/NdTt161942.jpg', 'immagine'),
(52, 'uploads/JwYZ163710.jpg', 'immagine'),
(53, 'uploads/bZHG163849.jpg', 'immagine'),
(54, 'uploads/EYjb163849.jpg', 'immagine'),
(55, 'uploads/pGLY165252.jpg', 'immagine'),
(56, 'https://infouma.fileli.unipi.it/', 'link'),
(57, 'uploads/diUi165541.jpg', 'immagine'),
(58, 'uploads/lZMi165811.jpg', 'immagine'),
(59, 'https://www.brand-news.it/player/agenzie/wpp-acquisisce-la-societa-di-intelligenza-artificiale-satalia/', 'link'),
(60, 'uploads/hRWE170110.jpg', 'immagine'),
(61, 'uploads/HMQC170727.mp4', 'video'),
(62, 'uploads/AeQo170853.jpg', 'immagine');

-- --------------------------------------------------------

--
-- Struttura della tabella `grafica`
--

CREATE TABLE `grafica` (
  `codiceGrafica` tinyint(4) NOT NULL,
  `coloreSfondo` varchar(6) NOT NULL,
  `coloreTitolo` varchar(6) NOT NULL,
  `coloreTesto` varchar(6) NOT NULL,
  `nomeGrafica` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `grafica`
--

INSERT INTO `grafica` (`codiceGrafica`, `coloreSfondo`, `coloreTitolo`, `coloreTesto`, `nomeGrafica`) VALUES
(1, 'FFFFFC', 'FF1B1C', '000000', 'Bianco/Rosso'),
(2, 'EFC5A9', '813F22', '813F22', 'Marrone'),
(3, 'A9EFDA', '543B44', '543B44', 'Verde/Viola');

-- --------------------------------------------------------

--
-- Struttura della tabella `inclusionecontenutoarticolo`
--

CREATE TABLE `inclusionecontenutoarticolo` (
  `articolo` int(11) NOT NULL,
  `contenuto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `inclusionecontenutoarticolo`
--

INSERT INTO `inclusionecontenutoarticolo` (`articolo`, `contenuto`) VALUES
(9, 30),
(10, 29),
(11, 46),
(12, 50),
(14, 52),
(15, 57),
(16, 60),
(17, 62);

-- --------------------------------------------------------

--
-- Struttura della tabella `inclusionecontenutopost`
--

CREATE TABLE `inclusionecontenutopost` (
  `post` int(11) NOT NULL,
  `contenuto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `inclusionecontenutopost`
--

INSERT INTO `inclusionecontenutopost` (`post`, `contenuto`) VALUES
(34, 39),
(35, 40),
(35, 41),
(36, 42),
(36, 43),
(37, 44),
(39, 45),
(40, 47),
(41, 48),
(41, 49),
(42, 53),
(42, 54),
(43, 55),
(43, 56),
(44, 58),
(44, 59),
(45, 61);

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `codicePost` int(11) NOT NULL,
  `autore` int(11) NOT NULL,
  `blog` int(11) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `testo` varchar(1500) NOT NULL,
  `dataOra` datetime NOT NULL,
  `tipologia` enum('immagine','video','audio','link','testo') NOT NULL,
  `numeroCommenti` int(11) NOT NULL DEFAULT 0 CHECK (`numeroCommenti` >= 0),
  `numeroVoti` int(11) NOT NULL DEFAULT 0 CHECK (`numeroVoti` >= 0),
  `mediaVoti` tinyint(4) NOT NULL DEFAULT 0 CHECK (0 <= `mediaVoti` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`codicePost`, `autore`, `blog`, `titolo`, `testo`, `dataOra`, `tipologia`, `numeroCommenti`, `numeroVoti`, `mediaVoti`) VALUES
(34, 6, 19, 'Le tartarughe si stanno estinguendo!', 'La tartaruga marina comune è la specie più diffusa nel Mediterraneo, ma sono presenti raramente anche altre specie, tra cui, anche se molto rara, la grande tartaruga liuto (Dermochelys coriacea). Nel mondo esistono in totale sette specie di tartarughe marine e sono tutte a rischio di estinzione, minacciate dalla cattura accidentale e dalla distruzione dei siti riproduttivi.', '2021-08-30 15:24:53', 'immagine', 0, 0, 0),
(35, 6, 19, 'Gli effetti del cambiamento climatico', 'Ognuno di noi dovrebbe leggere questo genere di articoli per capire la gravità della situazione!', '2021-08-30 15:26:12', 'link', 0, 0, 0),
(36, 2, 20, 'Windows 11 - tutti i dettagli', 'Microsoft aggiorna i requisiti per aggiornare a Windows 11. Vi lascio questo articolo per scoprirne di più\r\n\r\n', '2021-08-30 15:27:43', 'link', 0, 1, 5),
(37, 2, 20, 'Una nuova traccia creata con AI', 'Ho sempre detto che il mondo dell\'intelligenza artificiale è il più affascinante! ;)', '2021-08-30 15:28:43', 'audio', 0, 1, 3),
(38, 2, 21, 'Curiosità sulla cucina cinese!', 'La cucina cinese rappresenta la somma di cucine regionali anche molto diverse e si è evoluta anche in altre parti del mondo con caratteristiche diverse dall\'Asia orientale al Nord America, dall\'Australia all\'Europa occidentale. Si possono distinguere otto cucine regionali: Anhui, Cantonese, Fujian, Hunan, Jiangsu, Shandong, Sichuan e Zhejiang.', '2021-08-30 15:40:41', 'testo', 0, 0, 0),
(39, 2, 21, 'Il mio piatto preferito', 'La cucina cinese è tutta buona, ma nulla sarà mai all\'altezza dei ravioli!', '2021-08-30 15:41:40', 'immagine', 1, 1, 4),
(40, 2, 21, 'I fantastici ravioli', 'Ecco come preparo i ravioli in padella, senza vaporira', '2021-08-30 15:48:33', 'video', 0, 1, 5),
(41, 2, 21, 'Involtini primavera', 'Vi lascio la ricetta che replicherò stasera: involtini primavera!', '2021-08-30 15:49:50', 'link', 1, 1, 4),
(42, 8, 23, 'Thailandia -5', 'Cari lettori, \r\nsono molto emozionato di dirvi che fra soli 5 giorni l\'avventura avrà inizio!!!', '2021-08-30 16:38:49', 'immagine', 1, 0, 0),
(43, 9, 24, 'Il corso di laurea', 'Sei interessato a a studiare informatica umanistica? Iscriviti subito al seguente link!!!', '2021-08-30 16:52:52', 'link', 1, 2, 4),
(44, 8, 22, 'Ottimo acquisizione di WPP', 'Vi lascio questo interessante articolo. Ditemi cosa ne pensate!', '2021-08-30 16:58:11', 'link', 0, 0, 0),
(45, 6, 25, 'Qualcuno ha detto workout?', 'Ecco come inizio le mie giornate!', '2021-08-30 17:07:27', 'video', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `seguito`
--

CREATE TABLE `seguito` (
  `utente` int(11) NOT NULL,
  `blog` int(11) NOT NULL,
  `dataInizio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `seguito`
--

INSERT INTO `seguito` (`utente`, `blog`, `dataInizio`) VALUES
(9, 21, '2021-08-30'),
(10, 21, '2021-08-30'),
(10, 22, '2021-08-30');

-- --------------------------------------------------------

--
-- Struttura della tabella `sottotema`
--

CREATE TABLE `sottotema` (
  `codiceSottotema` tinyint(4) NOT NULL,
  `tema` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sottotema`
--

INSERT INTO `sottotema` (`codiceSottotema`, `tema`) VALUES
(3, 2),
(3, 10),
(4, 1),
(4, 7),
(6, 5),
(7, 1),
(8, 1),
(8, 7),
(10, 2),
(12, 9),
(13, 2),
(13, 10),
(14, 5),
(14, 6),
(15, 5),
(15, 6),
(17, 16),
(17, 18),
(18, 16),
(19, 16),
(19, 18),
(20, 9),
(20, 12),
(21, 9),
(21, 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--

CREATE TABLE `tag` (
  `codiceTag` int(11) NOT NULL,
  `chiaveTag` varchar(20) NOT NULL,
  `numeroArticoli` int(11) NOT NULL DEFAULT 0 CHECK (`numeroArticoli` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tag`
--

INSERT INTO `tag` (`codiceTag`, `chiaveTag`, `numeroArticoli`) VALUES
(1, 'prova', 1),
(2, 'dasdas', 1),
(3, 'dasad', 1),
(4, 'dasd', 1),
(5, 'fg', 1),
(6, 'basi di dati', 1),
(7, 'informatica', 1),
(8, 'windows11', 1),
(9, 'guidepc', 1),
(10, 'ecofriendly', 1),
(11, 'zeowaste', 1),
(12, 'recicle', 1),
(13, 'fastfashion', 1),
(14, 'pollution', 1),
(15, 'begreen', 1),
(16, 'chinese kitchen', 1),
(17, 'springrolls', 1),
(18, 'bao', 1),
(19, 'baozi', 1),
(20, 'artificialintelligen', 1),
(21, 'buisness', 1),
(22, 'robot', 1),
(23, 'walking', 1),
(24, 'nature', 2),
(25, 'thinking', 1),
(26, 'walk', 1),
(27, 'backpack', 1),
(28, 'adventure', 1),
(29, 'history', 1),
(30, 'publichistory', 1),
(31, 'museum', 1),
(32, 'digitalhumanities', 1),
(33, 'digitalmarketing', 1),
(34, 'artificialintelligen', 1),
(35, 'wellness', 1),
(36, 'fitness', 1),
(37, 'healthy', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tema`
--

CREATE TABLE `tema` (
  `codiceTema` tinyint(4) NOT NULL,
  `nomeTema` varchar(30) NOT NULL,
  `descrizione` varchar(1500) NOT NULL,
  `numeroBlog` int(11) NOT NULL DEFAULT 0 CHECK (`numeroBlog` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tema`
--

INSERT INTO `tema` (`codiceTema`, `nomeTema`, `descrizione`, `numeroBlog`) VALUES
(1, 'Informatica', 'L\'informatica è la scienza che si occupa del trattamento e della trasmissione delle informazioni per mezzo della loro elaborazione elettronica, che consente di gestire enormi quantità di dati e si presta all’applicazione in vari ambiti scientifici e pratici. \r\nUn blog di informatica tratta della disciplina a 360 gradi, fornendo consigli e informazioni circa hardware, software...', 0),
(2, 'Viaggi', 'Il viaggio è lo spostamento da un luogo a un altro, che si fa per divertimento o per necessità. Un blog di viaggi racconta l\'esperienze e le avventure dei viaggiatori e dà consigli a riguardo', 0),
(3, 'Fotografia', 'Procedimento che, mediante processi chimico-fisici, permette di ottenere, servendosi di un apposito apparecchio (macchina fotografica), l’immagine di persone, oggetti, strutture, situazioni. \r\nUn blog di informatica, oltre a fornire consigli su tecniche e apparecchi, mostra le immagini più belle', 0),
(4, 'Basi di dati', 'Le basi di dati sono quegli archivi elettronici di dati correlati, registrati nella memoria di un computer e organizzati in modo da poter essere facilmente, rapidamente e selettivamente rintracciabili uno per uno, oppure per gruppi determinati, mediante appositi programmi di gestione e di ricerca.\r\nUn blog sulle basi di dati fornisce consigli sull\'utilizzo delle basi di dati e tratta in generale il \"problema dei dati\"', 0),
(5, 'Informatica umanistica', 'L\'informatica umanistica si riferisce ai metodi e alle tecniche di applicazione dell\'informatica nelle diverse discipline umanistiche, in considerazione di un retroterra culturale comune e di alcuni punti di contatto sostanziali, individuabili soprattutto nelle caratteristiche unitarie che presentano sia i dati che devono essere identificati e descritti per divenire oggetto di elaborazione automatica, sia i metodi di indagine e le conseguenti ipotesi di lavoro (modelli) che devono essere resi espliciti e formalizzabili. \r\nUn blog di informatica umanistica fornisce consigli e informazioni su come l\'informatica possa fornire gli strumenti di accesso alla società dell\'informazione alla componente umanistica.', 0),
(6, 'Letteratura ', 'La letteratura è la conoscenza di ciò che è stato affidato alla scrittura, quindi in genere cultura, dottrina. Comprende l\'insieme delle opere affidate alla scrittura, che si propongano fini estetici, o, pur non proponendoseli, li raggiungano comunque; e, con significato più astratto, l\'attività intellettuale volta allo studio o all\'analisi di tali opere.\r\nUn blog di letteratura fornisce consigli e aggiornamenti letterari, oltre a produrre materiale divulgativo e informativo', 0),
(7, 'Tecnologia', 'Settore di ricerca multidisciplinare con oggetto lo sviluppo e l’applicazione di strumenti tecnici, ossia di quanto è applicabile alla soluzione di problemi pratici, all’ottimizzazione di procedure, alla presa di decisioni, alla scelta di strategie finalizzate a dati obiettivi, sulla base di conoscenze scientifiche comprese quelle matematiche e informatiche.\r\nUn blog di tecnologia riguarda l’uso ottimale, anche e soprattutto da un punto di vista economico, di tecniche, procedimenti e conoscenze tecnico-scientifiche avanzate in un dato settore, e l’insieme di elaborazioni teoriche e sistematiche applicabili alla pianificazione e alla razionalizzazione dell’intervento produttivo.', 0),
(8, 'Intelligenza artificiale', 'L\'intelligenza artificiale è la disciplina che studia se e in che modo si possano riprodurre i processi mentali più complessi mediante l\'uso di un computer. Tale ricerca si sviluppa secondo due percorsi complementari: da un lato l\'i. artificiale cerca di avvicinare il funzionamento dei computer alle capacità dell\'intelligenza umana, dall\'altro usa le simulazioni informatiche per fare ipotesi sui meccanismi utilizzati dalla mente umana.\r\nUn blog sull\'intelligenza artificiale fornisce informazioni divulgative e informative sull\'argomento.', 0),
(9, 'Ambiente', 'L\'ambiente è la situazione, \"l\'intorno\" in cui o con cui un elemento, fisico o virtuale, o una persona, si rapporta e si relaziona.\r\nUn blog sull\'ambiente tratta il tema in maniera divulgativa ed informativa e fornisce consigli su una maggiore salvaguardia dello stesso', 0),
(10, 'Cucina', 'L\'arte che presuppone l’operazione, l’attività, il modo di cucinare.\r\nUn blog di cucina fornisce ricette, consigli culinari ed enogastronomici ed informazioni su nuove tecniche e metodi di cucinare.', 0),
(12, 'Cambiamento climatico', 'Il cambiamento climatico riguarda la variazione del sistema climatico terrestre, determinata da cause antropiche. Nel concetto rientrano anche gli effetti di tale variazione sull’ambiente e sullo sviluppo sociale ed economico del genere umano concorrono a generare il cambiamento climatico.\r\nUn blog sul cambiamento climatico ha l\'obbiettivo di sensibilizzare, informare e divulgare', 0),
(13, 'Geografia', 'La geografia è quella scienza che ha per oggetto la descrizione interpretativa della superficie terrestre o di sue parti, intendendo per ‘superficie terrestre’ lo spazio tridimensionale dove la massa solida della Terra (litosfera) e quella liquida (idrosfera) vengono a contatto con l’involucro gassoso (atmosfera); spazio in cui si sviluppa la vita vegetale e animale e in cui si fissano le sedi e si svolgono le attività umane.\r\nUn blog sulla geografia ha il compito di fornire informazioni, divulgare e mostrare nuovi luoghi', 0),
(14, 'Storia', 'La storia riguarda il complesso delle azioni umane nel corso del tempo, nel senso sia degli eventi politici sia dei costumi e delle istituzioni in cui esse si sono organizzate. Modernamente, anche tutto ciò che le condiziona e ciò che esse coinvolgono (fatti geografici ed ecologici, fatti demografici, presupposti antropologici e sociologici, fatti economici).\r\nUn blog sulla storia ha il compito di fornire informazioni storiche, divulgare e analizzare le società nel tempo', 0),
(15, 'Linguistica Computazionale', 'La linguistica computazionale si concentra sullo sviluppo di formalismi descrittivi del funzionamento di una lingua naturale, che siano tali da poter essere trasformati in programmi eseguibili da computer.\r\nI problemi che affronta la linguistica computazionale – come intuibile dal nome stesso della disciplina – consistono nel trovare una mediazione fra il linguaggio umano, oggetto di studio in costante evoluzione, e le capacità di comprensione della macchina, limitate a quanto può essere descritto mediante regole formali.', 0),
(16, 'Sport', 'Attività intesa a sviluppare le capacità fisiche e insieme psichiche, e il complesso degli esercizi e delle manifestazioni, soprattutto agonistiche, in cui tale attività si realizza, praticati nel rispetto di regole codificate da appositi enti, sia per spirito competitivo (accompagnandosi o differenziandosi, così, dal gioco in senso proprio), sia, fin dalle origini, per divertimento, senza quindi il carattere di necessità, di obbligo, proprio di ogni attività lavorativa.', 0),
(17, 'Alimentazione', 'L\'alimentazione, in biologia, consiste nell\'assunzione da parte dell\'organismo, di alimenti indispensabili al suo metabolismo e alle sue funzioni vitali quotidiane prendendo in considerazione tutte le trasformazioni fisiche, chimiche e fisico-chimiche che i nutrienti assunti subiscono nel processo di digestione e/o assimilazione[1]. Essa è considerata specifica degli organismi eterotrofi: una pianta non si alimenta, assume nutrienti', 0),
(18, 'Salute', 'La salute è quello stato di benessere fisico e psichico, espressione di normalità strutturale e funzionale dell’organismo considerato nel suo insieme; il concetto di s. non corrisponde pertanto alla semplice assenza di malattie o di lesioni evolutive in atto, di deficit funzionali, di gravi mutilazioni, di rilevanti fenomeni patologici, ma esprime una condizione di complessiva efficienza psicofisica.', 0),
(19, 'Allenamento', 'L\'allenamento è un processo fisiologico di adattamento indotto dalla continua e regolare pratica dell’esercizio fisico, mirante a conferire maggiore forza, capacità di lavoro e resistenza alla fatica (o a conservare lo stato di forma). Occorre però sottolineare, da un lato, il fatto che lo studio delle caratteristiche bioenergetiche, biomeccaniche e biodinamiche delle attività sportive, associato all’arricchirsi della letteratura sul ruolo della psicologia e del sistema nervoso nelle stesse attività, ha reso più labile il confine distintivo tra allenamento psichico e fisico; dall’altro che nelle metodiche di allenamento influiscono gli aggiornamenti in campo medico-scientifico e le innovazioni tecnologiche introdotte nella pratica sportiva, che spesso arrivano a modificare, se non a stravolgere, la peculiarità del gesto tecnico e conseguentemente le necessità, quantitative e qualitative, di un lavoro a esso propedeutico. ', 0),
(20, 'Giardinaggio', 'Arte e tecnica di coltivare piante ornamentali per giardini, parchi, tappeti erbosi, aiuole, siepi ornamentali, rivestimenti di muri, pergolati, specchi d’acqua, e di disporle nel modo più opportuno nei singoli casi. Anche, il complesso delle operazioni relative alla coltivazione di tali piante', 0),
(21, 'Animali', 'L\'animale indica ogni essere animato, cioè ogni organismo vivente dotato di sensi e capace di movimenti spontanei: in questo senso, è un animale anche l’uomo.', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `trattazione`
--

CREATE TABLE `trattazione` (
  `blog` int(11) NOT NULL,
  `tema` tinyint(4) NOT NULL,
  `temaPrincipale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `trattazione`
--

INSERT INTO `trattazione` (`blog`, `tema`, `temaPrincipale`) VALUES
(19, 9, 1),
(19, 12, 0),
(20, 1, 1),
(20, 4, 0),
(20, 7, 0),
(20, 8, 0),
(21, 10, 1),
(21, 13, 0),
(22, 1, 1),
(22, 7, 0),
(22, 8, 0),
(23, 2, 1),
(23, 3, 0),
(23, 10, 0),
(23, 13, 0),
(24, 5, 1),
(24, 6, 0),
(24, 14, 0),
(24, 15, 0),
(25, 16, 1),
(25, 17, 0),
(25, 18, 0),
(25, 19, 0),
(26, 1, 1),
(26, 4, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `codiceUtente` int(11) NOT NULL,
  `nomeUtente` varchar(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cognome` varchar(150) NOT NULL,
  `email` varchar(254) NOT NULL,
  `parolaChiave` longtext NOT NULL,
  `dataRegistrazione` date NOT NULL,
  `telefono` char(10) NOT NULL,
  `estremiDocumento` char(9) NOT NULL,
  `dataNascita` date NOT NULL,
  `genere` enum('Maschio','Femmina','Altro') NOT NULL,
  `posizioneImgProfilo` text DEFAULT NULL,
  `biografia` varchar(1500) NOT NULL,
  `numeroBlog` tinyint(4) NOT NULL DEFAULT 0,
  `numeroCollaborazioni` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`codiceUtente`, `nomeUtente`, `nome`, `cognome`, `email`, `parolaChiave`, `dataRegistrazione`, `telefono`, `estremiDocumento`, `dataNascita`, `genere`, `posizioneImgProfilo`, `biografia`, `numeroBlog`, `numeroCollaborazioni`) VALUES
(2, 'daniele.borghesi', 'Daniele', 'Borghesi', 'borghedaniele@gmail.com', '$2y$10$ft6nATWmWTjbmtFRb3o8vuT4xpbCyI87tAsvzcL.AXtmuy9s5gZ3S', '2021-08-26', '3382922595', 'CA33737BB', '1999-04-22', 'Maschio', 'uploads/612cdedcdded34.09663257.jpg', 'Ciao mi chiamo Daniele! La mia passione è l\'informatica, ma sono anche un ottimo cuoco. Adoro la cucina cinese! Leggi i miei ultimi blog se ti va!', 0, 1),
(6, 'ari.tesc', 'arianna', 'Rossi', 'aia@unipisa.com', '$2y$10$6SNg/T4DXt.155o/pJX/WOTjpYJGM7hsQOGLBOOdHLWyLwnkOtZXC', '2021-08-29', '3333333333', 'CA33241SS', '1111-11-11', 'Femmina', 'uploads/612ccfcd117816.95123772.jpg', 'Ciao, sono Arianna. Sono un\'appassionata di salvaguardia ambientale e studio l\'impatto del cambiamento climatico. Seguitemi per leggere il mio blog, e lasciatemi un commento con la vostra opinione :)!', 0, -1),
(8, 'tommi.ro', 'Tommaso', 'Rossi', 'tommy.rossi@unipisa.it', '$2y$10$bOQW6nb7PIsmtN6inmrrCu6mP9SplVqTShH.XwkHhOJBQ8y5k8IcC', '2021-08-30', '3333123445', 'FB66334XC', '1998-03-22', 'Maschio', NULL, 'L’unica regola del viaggio è: non tornare come sei partito. Torna diverso. ', 0, 0),
(9, 'fedegar', 'Federico', 'Gargiulo', 'fedegar@yo.it', '$2y$10$ogtVwCcpCZ607TaoYdRdJuIITNOewi/lMUJBkyDFxfFTZqLEii0U.', '2021-08-30', '3333333322', 'FB46334XC', '1976-04-20', 'Maschio', NULL, 'Ciao sono Federico e sono un appassionato di Informatica Umanistica! Leggi i miei ultimi contenuti!', 0, 0),
(10, 'rossi_mary', 'Maria', 'Rossi', 'rossi_mary@unipisa.it', '$2y$10$XLdtEAx5vl5sH9Yr3rlcIOLxaN/15di.PDc2VuC2NKVbi3o1LDMtG', '2021-08-30', '3333333321', 'CA33421SS', '2000-03-12', 'Altro', 'uploads/612cf4e14d0958.72466120.jpg', 'Ciao a tutti! Sono Maria.', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `votoarticolo`
--

CREATE TABLE `votoarticolo` (
  `utente` int(11) NOT NULL,
  `articolo` int(11) NOT NULL,
  `dataOra` datetime NOT NULL,
  `votazione` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `votoarticolo`
--

INSERT INTO `votoarticolo` (`utente`, `articolo`, `dataOra`, `votazione`) VALUES
(9, 11, '2021-08-30 18:13:41', '5'),
(10, 14, '2021-08-30 17:10:38', '3'),
(10, 15, '2021-08-30 17:11:06', '4');

-- --------------------------------------------------------

--
-- Struttura della tabella `votopost`
--

CREATE TABLE `votopost` (
  `utente` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `dataOra` datetime NOT NULL,
  `votazione` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `votopost`
--

INSERT INTO `votopost` (`utente`, `post`, `dataOra`, `votazione`) VALUES
(2, 43, '2021-08-30 17:01:53', '4'),
(9, 36, '2021-08-30 18:04:46', '5'),
(9, 37, '2021-08-30 18:04:40', '3'),
(9, 43, '2021-08-30 18:11:09', '4'),
(10, 39, '2021-08-30 17:12:22', '4'),
(10, 40, '2021-08-30 17:12:19', '5'),
(10, 41, '2021-08-30 17:12:07', '4');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`codiceArticolo`),
  ADD KEY `fk_blogArticolo` (`blog`),
  ADD KEY `fk_autoreArticolo` (`autore`);

--
-- Indici per le tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`codiceBlog`),
  ADD KEY `fk_autoreBlog` (`autore`),
  ADD KEY `fk_graficaBlog` (`graficaBlog`);

--
-- Indici per le tabelle `caratterizzazionearticolo`
--
ALTER TABLE `caratterizzazionearticolo`
  ADD PRIMARY KEY (`articolo`,`tag`),
  ADD KEY `fk_tagCaratterizzazioneArticolo` (`tag`);

--
-- Indici per le tabelle `collaborazione`
--
ALTER TABLE `collaborazione`
  ADD PRIMARY KEY (`utente`,`blog`),
  ADD KEY `fk_blogCollaborazione` (`blog`);

--
-- Indici per le tabelle `commentoarticolo`
--
ALTER TABLE `commentoarticolo`
  ADD PRIMARY KEY (`codiceCommento`),
  ADD KEY `fk_autoreCommentoArticolo` (`autore`),
  ADD KEY `fk_articolocommentoArticolo` (`articolo`);

--
-- Indici per le tabelle `commentopost`
--
ALTER TABLE `commentopost`
  ADD PRIMARY KEY (`codiceCommento`),
  ADD KEY `fk_autoreCommentoPost` (`autore`),
  ADD KEY `fk_postCommentoPost` (`post`);

--
-- Indici per le tabelle `contenuto`
--
ALTER TABLE `contenuto`
  ADD PRIMARY KEY (`codiceContenuto`);

--
-- Indici per le tabelle `grafica`
--
ALTER TABLE `grafica`
  ADD PRIMARY KEY (`codiceGrafica`);

--
-- Indici per le tabelle `inclusionecontenutoarticolo`
--
ALTER TABLE `inclusionecontenutoarticolo`
  ADD PRIMARY KEY (`articolo`,`contenuto`),
  ADD KEY `fk_contenutoInclusioneContenutoArticolo` (`contenuto`);

--
-- Indici per le tabelle `inclusionecontenutopost`
--
ALTER TABLE `inclusionecontenutopost`
  ADD PRIMARY KEY (`post`,`contenuto`),
  ADD KEY `fk_contenutoInclusioneContenutoPost` (`contenuto`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`codicePost`),
  ADD KEY `fk_blogPost` (`blog`),
  ADD KEY `fk_autorePost` (`autore`);

--
-- Indici per le tabelle `seguito`
--
ALTER TABLE `seguito`
  ADD PRIMARY KEY (`utente`,`blog`),
  ADD KEY `fk_blogSéguito` (`blog`);

--
-- Indici per le tabelle `sottotema`
--
ALTER TABLE `sottotema`
  ADD PRIMARY KEY (`codiceSottotema`,`tema`),
  ADD KEY `fk_temaTema` (`tema`);

--
-- Indici per le tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`codiceTag`);

--
-- Indici per le tabelle `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`codiceTema`);

--
-- Indici per le tabelle `trattazione`
--
ALTER TABLE `trattazione`
  ADD PRIMARY KEY (`blog`,`tema`),
  ADD KEY `fk_temaTrattazione` (`tema`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`codiceUtente`),
  ADD UNIQUE KEY `nomeUtente` (`nomeUtente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `estremiDocumento` (`estremiDocumento`);

--
-- Indici per le tabelle `votoarticolo`
--
ALTER TABLE `votoarticolo`
  ADD PRIMARY KEY (`utente`,`articolo`),
  ADD KEY `fk_articoloVotoArticolo` (`articolo`);

--
-- Indici per le tabelle `votopost`
--
ALTER TABLE `votopost`
  ADD PRIMARY KEY (`utente`,`post`),
  ADD KEY `fk_postVotoPost` (`post`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `codiceArticolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `blog`
--
ALTER TABLE `blog`
  MODIFY `codiceBlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `commentoarticolo`
--
ALTER TABLE `commentoarticolo`
  MODIFY `codiceCommento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `commentopost`
--
ALTER TABLE `commentopost`
  MODIFY `codiceCommento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT per la tabella `contenuto`
--
ALTER TABLE `contenuto`
  MODIFY `codiceContenuto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT per la tabella `grafica`
--
ALTER TABLE `grafica`
  MODIFY `codiceGrafica` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `codicePost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `codiceTag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT per la tabella `tema`
--
ALTER TABLE `tema`
  MODIFY `codiceTema` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `codiceUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `fk_autoreArticolo` FOREIGN KEY (`autore`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_blogArticolo` FOREIGN KEY (`blog`) REFERENCES `blog` (`codiceBlog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `fk_autoreBlog` FOREIGN KEY (`autore`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_graficaBlog` FOREIGN KEY (`graficaBlog`) REFERENCES `grafica` (`codiceGrafica`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `caratterizzazionearticolo`
--
ALTER TABLE `caratterizzazionearticolo`
  ADD CONSTRAINT `fk_articoloCaratterizzazioneArticolo` FOREIGN KEY (`articolo`) REFERENCES `articolo` (`codiceArticolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tagCaratterizzazioneArticolo` FOREIGN KEY (`tag`) REFERENCES `tag` (`codiceTag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `collaborazione`
--
ALTER TABLE `collaborazione`
  ADD CONSTRAINT `fk_blogCollaborazione` FOREIGN KEY (`blog`) REFERENCES `blog` (`codiceBlog`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utenteCollaborazione` FOREIGN KEY (`utente`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commentoarticolo`
--
ALTER TABLE `commentoarticolo`
  ADD CONSTRAINT `fk_articolocommentoArticolo` FOREIGN KEY (`articolo`) REFERENCES `articolo` (`codiceArticolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_autoreCommentoArticolo` FOREIGN KEY (`autore`) REFERENCES `utente` (`codiceUtente`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `commentopost`
--
ALTER TABLE `commentopost`
  ADD CONSTRAINT `fk_autoreCommentoPost` FOREIGN KEY (`autore`) REFERENCES `utente` (`codiceUtente`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postCommentoPost` FOREIGN KEY (`post`) REFERENCES `post` (`codicePost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `inclusionecontenutoarticolo`
--
ALTER TABLE `inclusionecontenutoarticolo`
  ADD CONSTRAINT `fk_articoloInclusioneContenutoArticolo` FOREIGN KEY (`articolo`) REFERENCES `articolo` (`codiceArticolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contenutoInclusioneContenutoArticolo` FOREIGN KEY (`contenuto`) REFERENCES `contenuto` (`codiceContenuto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `inclusionecontenutopost`
--
ALTER TABLE `inclusionecontenutopost`
  ADD CONSTRAINT `fk_contenutoInclusioneContenutoPost` FOREIGN KEY (`contenuto`) REFERENCES `contenuto` (`codiceContenuto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postInclusioneContenutoPost` FOREIGN KEY (`post`) REFERENCES `post` (`codicePost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_autorePost` FOREIGN KEY (`autore`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_blogPost` FOREIGN KEY (`blog`) REFERENCES `blog` (`codiceBlog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `seguito`
--
ALTER TABLE `seguito`
  ADD CONSTRAINT `fk_blogSeguito` FOREIGN KEY (`blog`) REFERENCES `blog` (`codiceBlog`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utenteSeguito` FOREIGN KEY (`utente`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `sottotema`
--
ALTER TABLE `sottotema`
  ADD CONSTRAINT `fk_sottotemaTema` FOREIGN KEY (`tema`) REFERENCES `tema` (`codiceTema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_temaTema` FOREIGN KEY (`tema`) REFERENCES `tema` (`codiceTema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `trattazione`
--
ALTER TABLE `trattazione`
  ADD CONSTRAINT `fk_blogTrattazione` FOREIGN KEY (`blog`) REFERENCES `blog` (`codiceBlog`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_temaTrattazione` FOREIGN KEY (`tema`) REFERENCES `tema` (`codiceTema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `votoarticolo`
--
ALTER TABLE `votoarticolo`
  ADD CONSTRAINT `fk_articoloVotoArticolo` FOREIGN KEY (`articolo`) REFERENCES `articolo` (`codiceArticolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utenteVotoArticolo` FOREIGN KEY (`utente`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `votopost`
--
ALTER TABLE `votopost`
  ADD CONSTRAINT `fk_postVotoPost` FOREIGN KEY (`post`) REFERENCES `post` (`codicePost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utenteVotoPost` FOREIGN KEY (`utente`) REFERENCES `utente` (`codiceUtente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
