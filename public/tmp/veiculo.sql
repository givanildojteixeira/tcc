'RECONSTRUIR TABELA DE VEICULOS
Console:
php artisan migrate:refresh --path=database/migrations/NOME_DA_MIGRATION.php2025_03_18_233416_create_veiculos_table.php'

Insira no banco:
DELETE FROM `veiculos`
INSERT INTO `veiculos`(`chassi`, `novo_usado`, `marca`, `familia`, `desc_veiculo`, `modelo_fab`, `cor`, `cod_opcional`, `combustivel`, `Ano_Mod`, `motor`, `portas`, `vlr_tabela`, `vlr_bonus`, `vlr_nota`, `local`, `dta_faturamento`) 
VALUES 
('9BGEA43B0SB216889','Novo','GM','Montana','MONTANA 1.2T','5A43BS','BRANCO SUMMIT','R8A','FLE-Mec','2024/2025','1.2','4','137900','0','123300','Transito','19/12/2024'),
('9BGEY43T0SB218871','Novo','GM','Montana','MONTANA PREMIER','5Y43TS','PRATA SHARK','RFE','FLE-Aut','2024/2025','1.2','4','169200','0','158000','Matriz','29/01/2025'),
('9BGEA48A0SG221985','Novo','GM','Onix','ONIX 1.0A','5A48AS','BRANCO SUMMIT','R7A','FLE-Mec','2024/2025','1.0','4','96300','5000','88100','Matriz','28/11/2024'),
('9BGEA48A0SG222404','Novo','GM','Onix','ONIX 1.0A','5A48AS','BRANCO SUMMIT','R7A','FLE-Mec','2024/2025','1.0','4','96300','5000','88100','Filial','06/12/2024'),
('9BGEA48A0SG230868','Novo','GM','Onix','ONIX 1.0A','5A48AS','BRANCO SUMMIT','R7A','FLE-Mec','2024/2025','1.0','4','96300','5000','88100','Matriz','10/12/2024'),
('9BGEB48A0SG222769','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','92479','Matriz','28/11/2024'),
('9BGEB48A0SG222872','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','93900','Filial','02/12/2024'),
('9BGEB48A0SG222869','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','93900','Matriz','02/12/2024'),
('9BGEB48A0SG222856','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','93900','Matriz','02/12/2024'),
('9BGEB48A0SG228521','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','93900','Filial','05/12/2024'),
('9BGEB48A0SG231277','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','93900','Matriz','12/12/2024'),
('9BGEB48A0SG231318','Novo','GM','Onix','ONIX 1.0A LT','5B48AS','BRANCO SUMMIT','RGH','FLE-Mec','2024/2025','1.0','4','102800','7100','93900','Matriz','12/12/2024'),
('9BGEN48H0SG228649','Novo','GM','Onix','ONIX 1.0T LTZ','5N48HS','BRANCO SUMMIT','RGM','FLE-Aut','2024/2025','1.0','4','122900','2000','110400','Filial','17/12/2024'),
('9BGEN48H0SG231494','Novo','GM','Onix','ONIX 1.0T LTZ','5N48HS','PRATA SHARK','RGM','FLE-Aut','2024/2025','1.0','4','123600','2000','111100','Transito','16/12/2024'),
('9BGEN48H0SG231514','Novo','GM','Onix','ONIX 1.0T LTZ','5N48HS','PRATA SHARK','RGM','FLE-Aut','2024/2025','1.0','4','123600','2000','111100','Matriz','17/12/2024'),
('9BGEY48H0SG176048','Novo','GM','Onix','ONIX 1.0T PREMIER','5Y48HS','BRANCO SUMMIT','R7R','FLE-Aut','2024/2025','1.0','4','128500','5500','115783','Matriz','25/09/2024'),
('9BGEY48H0SG186422','Novo','GM','Onix','ONIX 1.0T PREMIER','5Y48HS','BRANCO SUMMIT','R7R','FLE-Aut','2024/2025','1.0','4','128500','5500','113200','Matriz','26/09/2024'),
('9BGEY48H0SG221381','Novo','GM','Onix','ONIX 1.0T PREMIER','5Y48HS','BRANCO SUMMIT','R7R','FLE-Aut','2024/2025','1.0','4','128500','2000','115500','Matriz','18/12/2024'),
('9BGEY48H0SG234188','Novo','GM','Onix','ONIX 1.0T PREMIER','5Y48HS','CINZA DRAKE','R7R','FLE-Aut','2024/2025','1.0','4','129200','2000','116200','Filial','16/12/2024'),
('9BGEY48H0SG234412','Novo','GM','Onix','ONIX 1.0T PREMIER','5Y48HS','VERMELHO CARMIM','R7R','FLE-Aut','2024/2025','1.0','4','129200','2000','116200','Matriz','19/12/2024'),
('9BGEY69H0SG176336','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','BRANCO SUMMIT','R8R','FLE-Aut','2024/2025','1.0','4','135900','5500','122557','Matriz','26/09/2024'),
('9BGEY69H0SG195820','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','BRANCO SUMMIT','R8R','FLE-Aut','2024/2025','1.0','4','135900','2000','122300','Filial','22/11/2024'),
('9BGEY69H0SG196079','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','BRANCO SUMMIT','R8R','FLE-Aut','2024/2025','1.0','4','135900','2000','122300','Matriz','23/11/2024'),
('9BGEY69H0SG196883','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','BRANCO SUMMIT','R8R','FLE-Aut','2024/2025','1.0','4','135900','2000','122300','Matriz','23/11/2024'),
('9BGEY69H0SG176173','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','BRANCO SUMMIT','R8R','FLE-Aut','2024/2025','1.0','4','135900','2000','122300','Transito','26/11/2024'),
('9BGEY69H0SG176317','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','BRANCO SUMMIT','R8R','FLE-Aut','2024/2025','1.0','4','135900','2000','122300','Matriz','26/11/2024'),
('9BGEY69H0SG190520','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','CINZA DRAKE','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Matriz','22/11/2024'),
('9BGEY69H0SG190529','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','CINZA DRAKE','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Filial','22/11/2024'),
('9BGEY69H0SG192146','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','CINZA DRAKE','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Matriz','22/11/2024'),
('9BGEY69H0SG217625','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','CINZA DRAKE','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Matriz','12/12/2024'),
('9BGEY69H0SG203634','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRATA SHARK','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Filial','26/11/2024'),
('9BGEY69H0SG219745','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRATA SHARK','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Matriz','12/12/2024'),
('9BGEY69H0SG238580','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRATA SHARK','R8R','FLE-Aut','2024/2025','1.0','4','136600','2000','123000','Matriz','20/12/2024'),
('9BGEY69H0SG188732','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRETO OURO NEGRO','R8R','FLE-Aut','2024/2025','1.0','4','134900','2000','121400','Matriz','21/11/2024'),
('9BGEY69H0SG182931','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRETO OURO NEGRO','R8R','FLE-Aut','2024/2025','1.0','4','134900','2000','119363','Transito','21/11/2024'),
('9BGEY69H0SG192986','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRETO OURO NEGRO','R8R','FLE-Aut','2024/2025','1.0','4','134900','2000','121400','Matriz','22/11/2024'),
('9BGEY69H0SG193012','Novo','GM','Onix Plus','ONIX PLUS 1.0T PREMIER','5Y69HS','PRETO OURO NEGRO','R8R','FLE-Aut','2024/2025','1.0','4','134900','2000','121400','Matriz','22/11/2024'),
('9BG148PK0SC425762','Novo','GM','S10','S10 HIGH COUNTRY','148PKS','CINZA MOSS','R7U','DIE-Aut','2024/2025','2.2','4','324500','0','292900','Transito','20/12/2024'),
('9BG148PK0SC427193','Novo','GM','S11','S10 HIGH COUNTRY','148PKS','CINZA TOPAZIO','R7U','DIE-Aut','2024/2025','2.2','4','325600','0','285292','Matriz','26/12/2024'),
('9BG148PK0SC419423','Novo','GM','S12','S10 HIGH COUNTRY','148PKS','PRATA SHARK','R7U','DIE-Aut','2024/2025','2.2','4','325600','0','285292','Matriz','28/11/2024'),
('9BG148PK0SC426958','Novo','GM','S13','S10 HIGH COUNTRY','148PKS','PRATA SHARK','R7U','DIE-Aut','2024/2025','2.2','4','325600','0','285292','Matriz','26/12/2024'),
('3GCUD9ED5RG241065','Novo','GM','Silverado','SILVERADO HIGH COUNTRY','3PJEDR','CINZA RUSH','PEB','GAS-Aut','2024/2024','4.3','4','540000','40000','472100','Filial','24/02/2025'),
('3GCUD9ED5RG388955','Novo','GM','Silverado','SILVERADO HIGH COUNTRY','3PJEDR','PRETO GLOBAL','PEB','GAS-Aut','2024/2024','4.3','4','540000','0','430300','Matriz','11/03/2025'),
('9BGJC7520SB242378','Novo','GM','Spin','SPIN LTZ','5C752S','BRANCO SUMMIT','R7S','FLE-Aut','2025/2025','1.2','4','144600','0','135100','Matriz','18/03/2025'),
('9BGEX76D0SB221022','Novo','GM','Tracker','TRACKER 1.0T','5X76DS','AZUL BOREAL','R8C','FLE-Aut','2024/2025','1.0','4','120000','0','114038','Matriz','19/12/2024'),
('9BGEX76H0SB208650','Novo','GM','Tracker','TRACKER 1.0T','5X76HS','AZUL BOREAL','RFC','FLE-Aut','2024/2025','1.0','4','120000','0','117500','Matriz','27/11/2024'),
('9BGEX76H0SB208735','Novo','GM','Tracker','TRACKER 1.0T','5X76HS','AZUL BOREAL','RFC','FLE-Aut','2024/2025','1.0','4','120000','0','117500','Transito','27/11/2024'),
('9BGEX76H0SB208808','Novo','GM','Tracker','TRACKER 1.0T','5X76HS','AZUL BOREAL','RFC','FLE-Aut','2024/2025','1.0','4','120000','0','117500','Matriz','29/11/2024'),
('9BGEX76H0SB208822','Novo','GM','Tracker','TRACKER 1.0T','5X76HS','AZUL BOREAL','RFC','FLE-Aut','2024/2025','1.0','4','120000','0','117500','Transito','30/11/2024'),
('9BGEX76H0SB206949','Novo','GM','Tracker','TRACKER 1.0T','5X76HS','BRANCO SUMMIT','RFC','FLE-Aut','2024/2025','1.0','4','120000','0','117500','Matriz','27/11/2024'),
('8AGEB76H0SR112866','Novo','GM','Tracker','TRACKER 1.0T LT','3B76HS','AZUL BOREAL','R9S','FLE-Aut','2024/2025','1.0','4','152000','3000','132400','Matriz','12/11/2024'),
('8AGEB76H0SR121498','Novo','GM','Tracker','TRACKER 1.0T LT','3B76HS','BRANCO SUMMIT','R9S','FLE-Aut','2024/2025','1.0','4','153000','3000','129394','Filial','19/12/2024'),
('8AGEB76H0SR121661','Novo','GM','Tracker','TRACKER 1.0T LT','3B76HS','CINZA RUSH','R9S','FLE-Aut','2024/2025','1.0','4','153900','3000','134200','Matriz','26/12/2024'),
('8AGEB76H0SR112361','Novo','GM','Tracker','TRACKER 1.0T LT','3B76HS','VERMELHO CHILI','R9S','FLE-Aut','2024/2025','1.0','4','153900','6500','133300','Matriz','16/10/2024'),
('9BGEB76H0SB192589','Novo','GM','Tracker','TRACKER 1.0T LT','5B76HS','BRANCO SUMMIT','RFD','FLE-Aut','2024/2025','1.0','4','153000','3000','133600','Matriz','27/11/2024'),
('9BGEN76D0SB218857','Novo','GM','Tracker','TRACKER 1.0T LTZ','5N76DS','PRATA SHARK','R8F','FLE-Aut','2024/2025','1.0','4','169100','0','148000','Matriz','21/12/2024'),
('8AGEP76B0SR106575','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','BRANCO SUMMIT','R9S','FLE-Aut','2024/2025','1.2','4','188000','7000','162469','Matriz','20/09/2024'),
('8AGEP76B0SR118874','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','BRANCO SUMMIT','R9S','FLE-Aut','2024/2025','1.2','4','188000','7000','164500','Transito','11/12/2024'),
('8AGEP76B0SR113388','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','BRANCO SUMMIT','R9S','FLE-Aut','2024/2025','1.2','4','188000','7000','164500','Matriz','11/12/2024'),
('8AGEP76B0SR116736','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','BRANCO SUMMIT','R9S','FLE-Aut','2024/2025','1.2','4','188000','7000','159621','Filial','23/12/2024'),
('8AGEP76B0SR116734','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','BRANCO SUMMIT','R9S','FLE-Aut','2024/2025','1.2','4','188000','7000','159621','Matriz','23/12/2024'),
('8AGEP76B0SR114748','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','CINZA RUSH','R9S','FLE-Aut','2024/2025','1.2','4','189900','7000','165300','Matriz','11/12/2024'),
('8AGEP76B0SR117821','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','CINZA RUSH','R9S','FLE-Aut','2024/2025','1.2','4','189900','7000','160435','Matriz','23/12/2024'),
('8AGEP76B0SR118160','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','PRATA SHARK','R9S','FLE-Aut','2024/2025','1.2','4','189900','7000','165300','Matriz','21/12/2024'),
('8AGEP76B0SR116505','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','PRATA SHARK','R9S','FLE-Aut','2024/2025','1.2','4','189900','7000','160435','Transito','23/12/2024'),
('8AGEP76B0SR119408','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','PRATA SHARK','R9S','FLE-Aut','2024/2025','1.2','4','189900','7000','165300','Matriz','26/12/2024'),
('8AGEP76B0SR119416','Novo','GM','Tracker','TRACKER 1.2T PREMIER','3P76BS','PRATA SHARK','R9S','FLE-Aut','2024/2025','1.2','4','189900','7000','165300','Matriz','26/12/2024'),
('9BGEP76B0SB170905','Novo','GM','Tracker','TRACKER 1.2T PREMIER','5P76BS','AZUL BOREAL','RFG','FLE-Aut','2024/2025','1.2','4','187000','7000','163800','Matriz','19/12/2024'),
('9BGEP76B0SB186012','Novo','GM','Tracker','TRACKER 1.2T PREMIER','5P76BS','CINZA MOSS','RFG','FLE-Aut','2024/2025','1.2','4','188000','7000','164700','Filial','13/12/2024'),
('9BGEP76B0SB181542','Novo','GM','Tracker','TRACKER 1.2T PREMIER','5P76BS','CINZA RUSH','RFG','FLE-Aut','2024/2025','1.2','4','189900','7000','165600','Matriz','19/12/2024'),
('9BGEP76B0SB184972','Novo','GM','Tracker','TRACKER 1.2T PREMIER','5P76BS','CINZA RUSH','RFG','FLE-Aut','2024/2025','1.2','4','189900','7000','160681','Matriz','19/12/2024'),
('9BGEP76B0SB167119','Novo','GM','Tracker','TRACKER 1.2T PREMIER','5P76BS','PRETO OURO NEGRO','RFG','FLE-Aut','2024/2025','1.2','4','189900','7000','160681','Filial','19/12/2024'),
('9BGEP76B0SB173807','Novo','GM','Tracker','TRACKER 1.2T PREMIER','5P76BS','VERMELHO CHILI','RFG','FLE-Aut','2024/2025','1.2','4','189900','7000','160681','Matriz','19/12/2024'),
('9BG156PK0SC425825','Novo','GM','TrailBlazer','TRAILBLAZER HIGH COUNTRY','156PKS','BRANCO SUMMIT','R6A','DIE-Aut','2024/2025','2.2','4','393600','0','344751','Transito','16/12/2024'),
('9BG156PK0SC425826','Novo','GM','TrailBlazer','TRAILBLAZER HIGH COUNTRY','156PKS','PRETO OURO NEGRO','R6A','DIE-Aut','2024/2025','2.2','4','394700','0','345746','Matriz','16/12/2024');