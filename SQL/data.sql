-- DROP SCHEMA sch_map;
drop schema sch_map;

-- CREATE SCHEMA sch_map;
CREATE SCHEMA sch_map;

-- sch_map.kenniskaart definition
-- Drop table

DROP TABLE if exists sch_map.kenniskaart cascade;

-- Create table
CREATE TABLE sch_map.kenniskaart (
                                     kenniskaart_id serial primary key NOT NULL,
                                     onderwerp varchar NOT NULL,
                                     rol varchar NOT NULL,
                                     competentie varchar NOT NULL,
                                     wat varchar NOT NULL,
                                     why varchar NOT NULL,
                                     how varchar NULL,
                                     plaatje varchar NOT NULL,
                                     bronnen varchar NOT NULL,
                                     niveau varchar NOT NULL,
                                     studieduur varchar NOT NULL,
                                     rating varchar NULL
);

-- Comments
    comment on table sch_map.kenniskaart
        is 'een tabel voor alle data van kenniskaarten';
    comment on column sch_map.kenniskaart.kenniskaart_id
        is 'een column en primary key voor het tabel kenniskaart';
    comment on column sch_map.kenniskaart.onderwerp
        is 'het onderwerp van de kenniskaart';
    comment on column sch_map.kenniskaart.rol
        is 'de rollen die toebehoren aan deze kenniskaart';
    comment on column sch_map.kenniskaart.competentie
        is 'aan welke HBO-I competenties de kenniskaart voldoet';
    comment on column sch_map.kenniskaart.wat
        is 'waar de kenniskaart over gaat';
    comment on column sch_map.kenniskaart.why
        is 'waarom de kenniskaart is gemaakt';
    comment on column sch_map.kenniskaart.how
        is 'hoe de kenniskaart gemaakt is';
    comment on column sch_map.kenniskaart.bronnen
        is 'de bronnen van de kenniskaart';
    comment on column sch_map.kenniskaart.niveau
        is 'het niveau van de kenniskaart';
    comment on column sch_map.kenniskaart.studieduur
        is 'hoelang het duur om de kenniskaart te bestuderen';
    comment on column sch_map.kenniskaart.rating
        is 'wat voor rating de kenniskaart is gegeven';

-- Data insert into
INSERT INTO sch_map.kenniskaart (onderwerp,rol,competentie,wat,why,how,plaatje,bronnen,niveau,studieduur,rating) VALUES
	 ('Back-end programmeren: Python','BE,AI,CSC','Software Realiseren','Programmeren leer je door het te doen. Er zijn diverse websites, tutorials en presentaties om Python te leren programmeren. ','Leren programmeren met Python','Programmeren leer je door het te doen. Er zijn diverse websites, tutorials en presentaties om Python te leren programmeren. ','https://miro.medium.com/max/840/1*RJMxLdTHqVBSijKmOO5MAg.jpeg','https://www.w3schools.com/, https://www.codecademy.com/, https://canvas.hu.nl/courses/12085/files/279694/download?wrap=1, https://canvas.hu.nl/courses/12085/files/279695/download?wrap=1, https://canvas.hu.nl/courses/12085/files/279696/download?wrap=1, https://canvas.hu.nl/courses/12085/files/279698/download?wrap=1, https://canvas.hu.nl/courses/12085/files/279699/download?wrap=1','Beginner','8 weken','5'),
	 ('Testen: Software Testen, Unit en Algoritme','FE,BE,AI,CSC','Software Realiseren','Als je programmas maakt dan ontkom je er niet aan om te testen. Testen om te verifiëren of het programma voldoet aan de eisen en testen of het product voldoet aan de verwachtingen (validiteit). Er zijn diverse soorten testen met bijbehorende teststrategieën.  Een van de laatste testsoorten is mutatietesten. Verander je code op bepaalde plekken en verwacht een fout resultaat. Voor deze test en de andere soorten zijn vele tools beschikbaar om het geheel geautomatiseerd te laten verlopen.','software testen unit algoritme Unittesten, integratietesten, algoritmetesten, activiteitendiagram','Unittesten, integratietesten, algoritmetesten, activiteitendiagram','https://cdn.educba.com/academy/wp-content/uploads/2019/05/software-testing-principles.jpg','https://stackoverflow.com/, https://www.sonarqube.org/','Gevorderde','3 uur','5'),
	 ('Value Proposition Canvas (VPC)','PO','Gebruikersinteractie Analyseren','VPC is een instrument om een product visie te ontwerpen op basis van de belangrijkste wensen van een doelgroep en deze te vertalen naar een product/dienst','Wordt onder andere  toegepast voor het definieren  van een product visie','Model waarin je eerst vanuit de gebruiker kijkt welke taken die moet verrichten, die je met een slimme it oplossing (app, iot, ai, etc) wilt verbeteren. je kijkt daarbij naar de pijn die gebruikers nu ervaren in het verrichten van die taak (bijvoorbeeld het boeken van een mooie klimvakantie) en welke extra gains (voordelen) je kunt bedenken om de gebruiker bij die taak nog extra te ondersteunen. Vanuit de gains en pains bedenk je dan een IT oplossing die daar antwoord op moet geven. Is een heel goed brainstorm model om mee te starten en productideeen mee uit te werken. Wordt veel door start-ups gebruikt.','https://823876.smushcdn.com/1388915/wp-content/uploads/2018/03/value-proposition-canvas.png?lossy=0&strip=0&webp=1','https://www.strategyzer.com/canvas/value-proposition-canvas, https://canvas.hu.nl/courses/12085/files/1119653/download?wrap=1','Beginner','30 minuten','3'),
	 ('Processen modelleren met BPMN','PO','Organisatieprocessen Analyseren,Organisatieprocessen Adviseren','BPMN is een procesmodelleringstechniek, waarmee bestaande  en nieuwe organisatieprocessen grafisch gemodelleerd kunnen worden.  De techniek wordt gebruikt om te kijken of bepaalde stappen in het proces met bijvoorbeeld technologie verbeterd kunnen worden. Veelal is het de basis voor een requirementsanalyse.','modelleren bpmn','Door interviews met gebruikers en het bestuderen van de bestaande processen kan via zogenaamde flowchart technieken een organisatieproces in kaart worden gebracht. BPMN is een veel gebruikte internationale standaard voor procesmodellering die goed aansluit bij ICT modelleringstechnieken. ','https://www.mcftech.com/wp-content/uploads/2014/08/BPMN-Sample-Workflow.png','https://open.hpi.de/courses/bpm2019','Gevorderde','30 uur','4'),
	 ('Vaststellen van de klantreis (Customer Journey)','PO','Organisatieprocessen Analyseren,Organisatieprocessen Adviseren,Organisatieprocessen Ontwerpen','De CJ is een grafische weergave van de klantreis langs alle contactmomenteren van de organisatie en dient als basis voor het verbeteren van deze contactmomenten (touchpoints)','Per klantcontact wordt een analyse gemaakt in hoeverre klanten tevreden zijn met het proces dat ze doorlopen.','Dit CJ betreft de complete klantreis langs alle fasen in het klantcontact. Vaak wordt hierbij onderscheid gemaakt in de fasen van pre-sales, sales en aftersales. Ook zijn er uitgebreidere fasen die spreken over: awareness (bewustzijn), consideration (overweging), purchase (aankoop), delivery(levering) en als laatste loyalty (loyaliteit). Per klantcontact wordt een analyse gemaakt in hoeverre klanten dit klantcontact positief (vaak smiliy), neutraal of negatief (huily) ervaren','https://canvas.hu.nl/courses/12085/files/271993/download?wrap=1','https://customerscope.nl/customer-journey-wat-is-het/','Beginner','30','4');
