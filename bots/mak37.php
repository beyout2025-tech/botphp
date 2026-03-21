<?php#*wataw*

function has_emojis($string ) {
$unicodes = array( '1F600','1F603','1F604','1F601','1F606','1F605','1F923','1F602','1F642','1F643','1F609','1F60A','1F607','1F970','1F60D','1F929','1F618','1F617','263A','1F61A','1F619','1F60B','1F61B','1F61C','1F92A','1F61D','1F911','1F917','1F92D','1F92B','1F914','1F910','1F928','1F610','1F611','1F636','1F60F','1F612','1F644','1F62C','1F925','1F60C','1F614','1F62A','1F924','1F634','1F637','1F912','1F915','1F922','1F92E','1F927','1F975','1F976','1F974','1F635','1F92F','1F920','1F973','1F60E','1F913','1F9D0','1F615','1F61F','1F641','2639','1F62E','1F62F','1F632','1F633','1F97A','1F626','1F627','1F628','1F630','1F625','1F622','1F62D','1F631','1F616','1F623','1F61E','1F613','1F629','1F62B','1F971','1F624','1F621','1F620','1F92C','1F608','1F47F','1F480','2620','1F4A9','1F921','1F479','1F47A','1F47B','1F47D','1F47E','1F916','1F63A','1F638','1F639','1F63B','1F63C','1F63D','1F640','1F63F','1F63E','1F648','1F649','1F64A','1F48B','1F48C','1F498','1F49D','1F496','1F497','1F493','1F49E','1F495','1F49F','2763','1F494','2764','1F9E1','1F49B','1F49A','1F499','1F49C','1F90E','1F5A4','1F90D','1F4AF','1F4A2','1F4A5','1F4AB','1F4A6','1F4A8','1F573','1F4A3','1F4AC','1F441','FE0F','200D','1F5E8','FE0F','1F5E8','1F5EF','1F4AD','1F4A4','1F44B','1F91A','1F590','270B','1F596','1F44C','1F90F','270C','1F91E','1F91F','1F918','1F919','1F448','1F449','1F446','1F595','1F447','261D','1F44D','1F44E','270A','1F44A','1F91B','1F91C','1F44F','1F64C','1F450','1F932','1F91D','1F64F','270D','1F485','1F933','1F4AA','1F9BE','1F9BF','1F9B5','1F9B6','1F442','1F9BB','1F443','1F9E0','1F9B7','1F9B4','1F440','1F441','1F445','1F444','1F476','1F9D2','1F466','1F467','1F9D1','1F471','1F468','1F9D4','1F471','200D','2642','FE0F','1F468','200D','1F9B0','1F468','200D','1F9B1','1F468','200D','1F9B3','1F468','200D','1F9B2','1F469','1F471','200D','2640','FE0F','1F469','200D','1F9B0','1F469','200D','1F9B1','1F469','200D','1F9B3','1F469','200D','1F9B2','1F9D3','1F474','1F475','1F64D','1F64D','200D','2642','FE0F','1F64D','200D','2640','FE0F','1F64E','1F64E','200D','2642','FE0F','1F64E','200D','2640','FE0F','1F645','1F645','200D','2642','FE0F','1F645','200D','2640','FE0F','1F646','1F646','200D','2642','FE0F','1F646','200D','2640','FE0F','1F481','1F481','200D','2642','FE0F','1F481','200D','2640','FE0F','1F64B','1F64B','200D','2642','FE0F','1F64B','200D','2640','FE0F','1F9CF','1F9CF','200D','2642','FE0F','1F9CF','200D','2640','FE0F','1F647','1F647','200D','2642','FE0F','1F647','200D','2640','FE0F','1F926','1F926','200D','2642','FE0F','1F926','200D','2640','FE0F','1F937','1F937','200D','2642','FE0F','1F937','200D','2640','FE0F','1F468','200D','2695','FE0F','1F469','200D','2695','FE0F','1F468','200D','1F393','1F469','200D','1F393','1F468','200D','1F3EB','1F469','200D','1F3EB','1F468','200D','2696','FE0F','1F469','200D','2696','FE0F','1F468','200D','1F33E','1F469','200D','1F33E','1F468','200D','1F373','1F469','200D','1F373','1F468','200D','1F527','1F469','200D','1F527','1F468','200D','1F3ED','1F469','200D','1F3ED','1F468','200D','1F4BC','1F469','200D','1F4BC','1F468','200D','1F52C','1F469','200D','1F52C','1F468','200D','1F4BB','1F469','200D','1F4BB','1F468','200D','1F3A4','1F469','200D','1F3A4','1F468','200D','1F3A8','1F469','200D','1F3A8','1F468','200D','2708','FE0F','1F469','200D','2708','FE0F','1F468','200D','1F680','1F469','200D','1F680','1F468','200D','1F692','1F469','200D','1F692','1F46E','1F46E','200D','2642','FE0F','1F46E','200D','2640','FE0F','1F575','1F575','FE0F','200D','2642','FE0F','1F575','FE0F','200D','2640','FE0F','1F482','1F482','200D','2642','FE0F','1F482','200D','2640','FE0F','1F477','1F477','200D','2642','FE0F','1F477','200D','2640','FE0F','1F934','1F478','1F473','1F473','200D','2642','FE0F','1F473','200D','2640','FE0F','1F472','1F9D5','1F935','1F470','1F930','1F931','1F47C','1F385','1F936','1F9B8','1F9B8','200D','2642','FE0F','1F9B8','200D','2640','FE0F','1F9B9','1F9B9','200D','2642','FE0F','1F9B9','200D','2640','FE0F','1F9D9','1F9D9','200D','2642','FE0F','1F9D9','200D','2640','FE0F','1F9DA','1F9DA','200D','2642','FE0F','1F9DA','200D','2640','FE0F','1F9DB','1F9DB','200D','2642','FE0F','1F9DB','200D','2640','FE0F','1F9DC','1F9DC','200D','2642','FE0F','1F9DC','200D','2640','FE0F','1F9DD','1F9DD','200D','2642','FE0F','1F9DD','200D','2640','FE0F','1F9DE','1F9DE','200D','2642','FE0F','1F9DE','200D','2640','FE0F','1F9DF','1F9DF','200D','2642','FE0F','1F9DF','200D','2640','FE0F','1F486','1F486','200D','2642','FE0F','1F486','200D','2640','FE0F','1F487','1F487','200D','2642','FE0F','1F487','200D','2640','FE0F','1F6B6','1F6B6','200D','2642','FE0F','1F6B6','200D','2640','FE0F','1F9CD','1F9CD','200D','2642','FE0F','1F9CD','200D','2640','FE0F','1F9CE','1F9CE','200D','2642','FE0F','1F9CE','200D','2640','FE0F','1F468','200D','1F9AF','1F469','200D','1F9AF','1F468','200D','1F9BC','1F469','200D','1F9BC','1F468','200D','1F9BD','1F469','200D','1F9BD','1F3C3','1F3C3','200D','2642','FE0F','1F3C3','200D','2640','FE0F','1F483','1F57A','1F574','1F46F','1F46F','200D','2642','FE0F','1F46F','200D','2640','FE0F','1F9D6','1F9D6','200D','2642','FE0F','1F9D6','200D','2640','FE0F','1F9D7','1F9D7','200D','2642','FE0F','1F9D7','200D','2640','FE0F','1F93A','1F3C7','26F7','1F3C2','1F3CC','1F3CC','FE0F','200D','2642','FE0F','1F3CC','FE0F','200D','2640','FE0F','1F3C4','1F3C4','200D','2642','FE0F','1F3C4','200D','2640','FE0F','1F6A3','1F6A3','200D','2642','FE0F','1F6A3','200D','2640','FE0F','1F3CA','1F3CA','200D','2642','FE0F','1F3CA','200D','2640','FE0F','26F9','26F9','FE0F','200D','2642','FE0F','26F9','FE0F','200D','2640','FE0F','1F3CB','1F3CB','FE0F','200D','2642','FE0F','1F3CB','FE0F','200D','2640','FE0F','1F6B4','1F6B4','200D','2642','FE0F','1F6B4','200D','2640','FE0F','1F6B5','1F6B5','200D','2642','FE0F','1F6B5','200D','2640','FE0F','1F938','1F938','200D','2642','FE0F','1F938','200D','2640','FE0F','1F93C','1F93C','200D','2642','FE0F','1F93C','200D','2640','FE0F','1F93D','1F93D','200D','2642','FE0F','1F93D','200D','2640','FE0F','1F93E','1F93E','200D','2642','FE0F','1F93E','200D','2640','FE0F','1F939','1F939','200D','2642','FE0F','1F939','200D','2640','FE0F','1F9D8','1F9D8','200D','2642','FE0F','1F9D8','200D','2640','FE0F','1F6C0','1F6CC','1F9D1','200D','1F91D','200D','1F9D1','1F46D','1F46B','1F46C','1F48F','1F469','200D','2764','FE0F','200D','1F48B','200D','1F468','1F468','200D','2764','FE0F','200D','1F48B','200D','1F468','1F469','200D','2764','FE0F','200D','1F48B','200D','1F469','1F491','1F469','200D','2764','FE0F','200D','1F468','1F468','200D','2764','FE0F','200D','1F468','1F469','200D','2764','FE0F','200D','1F469','1F46A','1F468','200D','1F469','200D','1F466','1F468','200D','1F469','200D','1F467','1F468','200D','1F469','200D','1F467','200D','1F466','1F468','200D','1F469','200D','1F466','200D','1F466','1F468','200D','1F469','200D','1F467','200D','1F467','1F468','200D','1F468','200D','1F466','1F468','200D','1F468','200D','1F467','1F468','200D','1F468','200D','1F467','200D','1F466','1F468','200D','1F468','200D','1F466','200D','1F466','1F468','200D','1F468','200D','1F467','200D','1F467','1F469','200D','1F469','200D','1F466','1F469','200D','1F469','200D','1F467','1F469','200D','1F469','200D','1F467','200D','1F466','1F469','200D','1F469','200D','1F466','200D','1F466','1F469','200D','1F469','200D','1F467','200D','1F467','1F468','200D','1F466','1F468','200D','1F466','200D','1F466','1F468','200D','1F467','1F468','200D','1F467','200D','1F466','1F468','200D','1F467','200D','1F467','1F469','200D','1F466','1F469','200D','1F466','200D','1F466','1F469','200D','1F467','1F469','200D','1F467','200D','1F466','1F469','200D','1F467','200D','1F467','1F5E3','1F464','1F465','1F463','1F9B0','1F9B1','1F9B3','1F9B2','1F435','1F412','1F98D','1F9A7','1F436','1F415','1F9AE','1F415','200D','1F9BA','1F429','1F43A','1F98A','1F99D','1F431','1F408','1F981','1F42F','1F405','1F406','1F434','1F40E','1F984','1F993','1F98C','1F42E','1F402','1F403','1F404','1F437','1F416','1F417','1F43D','1F40F','1F411','1F410','1F42A','1F42B','1F999','1F992','1F418','1F98F','1F99B','1F42D','1F401','1F400','1F439','1F430','1F407','1F43F','1F994','1F987','1F43B','1F428','1F43C','1F9A5','1F9A6','1F9A8','1F998','1F9A1','1F43E','1F983','1F414','1F413','1F423','1F424','1F425','1F426','1F427','1F54A','1F985','1F986','1F9A2','1F989','1F9A9','1F99A','1F99C','1F438','1F40A','1F422','1F98E','1F40D','1F432','1F409','1F995','1F996','1F433','1F40B','1F42C','1F41F','1F420','1F421','1F988','1F419','1F41A','1F40C','1F98B','1F41B','1F41C','1F41D','1F41E','1F997','1F577','1F578','1F982','1F99F','1F9A0','1F490','1F338','1F4AE','1F3F5','1F339','1F940','1F33A','1F33B','1F33C','1F337','1F331','1F332','1F333','1F334','1F335','1F33E','1F33F','2618','1F340','1F341','1F342','1F343','1F347','1F348','1F349','1F34A','1F34B','1F34C','1F34D','1F96D','1F34E','1F34F','1F350','1F351','1F352','1F353','1F95D','1F345','1F965','1F951','1F346','1F954','1F955','1F33D','1F336','1F952','1F96C','1F966','1F9C4','1F9C5','1F344','1F95C','1F330','1F35E','1F950','1F956','1F968','1F96F','1F95E','1F9C7','1F9C0','1F356','1F357','1F969','1F953','1F354','1F35F','1F355','1F32D','1F96A','1F32E','1F32F','1F959','1F9C6','1F95A','1F373','1F958','1F372','1F963','1F957','1F37F','1F9C8','1F9C2','1F96B','1F371','1F358','1F359','1F35A','1F35B','1F35C','1F35D','1F360','1F362','1F363','1F364','1F365','1F96E','1F361','1F95F','1F960','1F961','1F980','1F99E','1F990','1F991','1F9AA','1F366','1F367','1F368','1F369','1F36A','1F382','1F370','1F9C1','1F967','1F36B','1F36C','1F36D','1F36E','1F36F','1F37C','1F95B','2615','1F375','1F376','1F37E','1F377','1F378','1F379','1F37A','1F37B','1F942','1F943','1F964','1F9C3','1F9C9','1F9CA','1F962','1F37D','1F374','1F944','1F52A','1F3FA','1F30D','1F30E','1F30F','1F310','1F5FA','1F5FE','1F9ED','1F3D4','26F0','1F30B','1F5FB','1F3D5','1F3D6','1F3DC','1F3DD','1F3DE','1F3DF','1F3DB','1F3D7','1F9F1','1F3D8','1F3DA','1F3E0','1F3E1','1F3E2','1F3E3','1F3E4','1F3E5','1F3E6','1F3E8','1F3E9','1F3EA','1F3EB','1F3EC','1F3ED','1F3EF','1F3F0','1F492','1F5FC','1F5FD','26EA','1F54C','1F6D5','1F54D','26E9','1F54B','26F2','26FA','1F301','1F303','1F3D9','1F304','1F305','1F306','1F307','1F309','2668','1F3A0','1F3A1','1F3A2','1F488','1F3AA','1F682','1F683','1F684','1F685','1F686','1F687','1F688','1F689','1F68A','1F69D','1F69E','1F68B','1F68C','1F68D','1F68E','1F690','1F691','1F692','1F693','1F694','1F695','1F696','1F697','1F698','1F699','1F69A','1F69B','1F69C','1F3CE','1F3CD','1F6F5','1F9BD','1F9BC','1F6FA','1F6B2','1F6F4','1F6F9','1F68F','1F6E3','1F6E4','1F6E2','26FD','1F6A8','1F6A5','1F6A6','1F6D1','1F6A7','2693','26F5','1F6F6','1F6A4','1F6F3','26F4','1F6E5','1F6A2','2708','1F6E9','1F6EB','1F6EC','1FA82','1F4BA','1F681','1F69F','1F6A0','1F6A1','1F6F0','1F680','1F6F8','1F6CE','1F9F3','231B','23F3','231A','23F0','23F1','23F2','1F570','1F55B','1F567','1F550','1F55C','1F551','1F55D','1F552','1F55E','1F553','1F55F','1F554','1F560','1F555','1F561','1F556','1F562','1F557','1F563','1F558','1F564','1F559','1F565','1F55A','1F566','1F311','1F312','1F313','1F314','1F315','1F316','1F317','1F318','1F319','1F31A','1F31B','1F31C','1F321','2600','1F31D','1F31E','1FA90','2B50','1F31F','1F320','1F30C','2601','26C5','26C8','1F324','1F325','1F326','1F327','1F328','1F329','1F32A','1F32B','1F32C','1F300','1F308','1F302','2602','2614','26F1','26A1','2744','2603','26C4','2604','1F525','1F4A7','1F30A','1F383','1F384','1F386','1F387','1F9E8','2728','1F388','1F389','1F38A','1F38B','1F38D','1F38E','1F38F','1F390','1F391','1F9E7','1F380','1F381','1F397','1F39F','1F3AB','1F396','1F3C6','1F3C5','1F947','1F948','1F949','26BD','26BE','1F94E','1F3C0','1F3D0','1F3C8','1F3C9','1F3BE','1F94F','1F3B3','1F3CF','1F3D1','1F3D2','1F94D','1F3D3','1F3F8','1F94A','1F94B','1F945','26F3','26F8','1F3A3','1F93F','1F3BD','1F3BF','1F6F7','1F94C','1F3AF','1FA80','1FA81','1F3B1','1F52E','1F9FF','1F3AE','1F579','1F3B0','1F3B2','1F9E9','1F9F8','2660','2665','2666','2663','265F','1F0CF','1F004','1F3B4','1F3AD','1F5BC','1F3A8','1F9F5','1F9F6','1F453','1F576','1F97D','1F97C','1F9BA','1F454','1F455','1F456','1F9E3','1F9E4','1F9E5','1F9E6','1F457','1F458','1F97B','1FA71','1FA72','1FA73','1F459','1F45A','1F45B','1F45C','1F45D','1F6CD','1F392','1F45E','1F45F','1F97E','1F97F','1F460','1F461','1FA70','1F462','1F451','1F452','1F3A9','1F393','1F9E2','26D1','1F4FF','1F484','1F48D','1F48E','1F507','1F508','1F509','1F50A','1F4E2','1F4E3','1F4EF','1F514','1F515','1F3BC','1F3B5','1F3B6','1F399','1F39A','1F39B','1F3A4','1F3A7','1F4FB','1F3B7','1F3B8','1F3B9','1F3BA','1F3BB','1FA95','1F941','1F4F1','1F4F2','260E','1F4DE','1F4DF','1F4E0','1F50B','1F50C','1F4BB','1F5A5','1F5A8','2328','1F5B1','1F5B2','1F4BD','1F4BE','1F4BF','1F4C0','1F9EE','1F3A5','1F39E','1F4FD','1F3AC','1F4FA','1F4F7','1F4F8','1F4F9','1F4FC','1F50D','1F50E','1F56F','1F4A1','1F526','1F3EE','1FA94','1F4D4','1F4D5','1F4D6','1F4D7','1F4D8','1F4D9','1F4DA','1F4D3','1F4D2','1F4C3','1F4DC','1F4C4','1F4F0','1F5DE','1F4D1','1F516','1F3F7','1F4B0','1F4B4','1F4B5','1F4B6','1F4B7','1F4B8','1F4B3','1F9FE','1F4B9','1F4B1','1F4B2','2709','1F4E7','1F4E8','1F4E9','1F4E4','1F4E5','1F4E6','1F4EB','1F4EA','1F4EC','1F4ED','1F4EE','1F5F3','270F','2712','1F58B','1F58A','1F58C','1F58D','1F4DD','1F4BC','1F4C1','1F4C2','1F5C2','1F4C5','1F4C6','1F5D2','1F5D3','1F4C7','1F4C8','1F4C9','1F4CA','1F4CB','1F4CC','1F4CD','1F4CE','1F587','1F4CF','1F4D0','2702','1F5C3','1F5C4','1F5D1','1F512','1F513','1F50F','1F510','1F511','1F5DD','1F528','1FA93','26CF','2692','1F6E0','1F5E1','2694','1F52B','1F3F9','1F6E1','1F527','1F529','2699','1F5DC','2696','1F9AF','1F517','26D3','1F9F0','1F9F2','2697','1F9EA','1F9EB','1F9EC','1F52C','1F52D','1F4E1','1F489','1FA78','1F48A','1FA79','1FA7A','1F6AA','1F6CF','1F6CB','1FA91','1F6BD','1F6BF','1F6C1','1FA92','1F9F4','1F9F7','1F9F9','1F9FA','1F9FB','1F9FC','1F9FD','1F9EF','1F6D2','1F6AC','26B0','26B1','1F5FF','1F3E7','1F6AE','1F6B0','267F','1F6B9','1F6BA','1F6BB','1F6BC','1F6BE','1F6C2','1F6C3','1F6C4','1F6C5','26A0','1F6B8','26D4','1F6AB','1F6B3','1F6AD','1F6AF','1F6B1','1F6B7','1F4F5','1F51E','2622','2623','2B06','2197','27A1','2198','2B07','2199','2B05','2196','2195','2194','21A9','21AA','2934','2935','1F503','1F504','1F519','1F51A','1F51B','1F51C','1F51D','1F6D0','269B','1F549','2721','2638','262F','271D','2626','262A','262E','1F54E','1F52F','2648','2649','264A','264B','264C','264D','264E','264F','2650','2651','2652','2653','26CE','1F500','1F501','1F502','25B6','23E9','23ED','23EF','25C0','23EA','23EE','1F53C','23EB','1F53D','23EC','23F8','23F9','23FA','23CF','1F3A6','1F505','1F506','1F4F6','1F4F3','1F4F4','2640','2642','2695','267E','267B','269C','1F531','1F4DB','1F530','2B55','2705','2611','2714','2716','274C','274E','2795','2796','2797','27B0','27BF','303D','2733','2734','2747','203C','2049','2753','2754','2755','2757','3030','00A9','00AE','2122','0023','FE0F','20E3','002A','FE0F','20E3','0030','FE0F','20E3','0031','FE0F','20E3','0032','FE0F','20E3','0033','FE0F','20E3','0034','FE0F','20E3','0035','FE0F','20E3','0036','FE0F','20E3','0037','FE0F','20E3','0038','FE0F','20E3','0039','FE0F','20E3','1F51F','1F520','1F521','1F522','1F523','1F524','1F170','1F18E','1F171','1F191','1F192','1F193','2139','1F194','24C2','1F195','1F196','1F17E','1F197','1F17F','1F198','1F199','1F19A','1F201','1F202','1F237','1F236','1F22F','1F250','1F239','1F21A','1F232','1F251','1F238','1F234','1F233','3297','3299','1F23A','1F235','1F534','1F7E0','1F7E1','1F7E2','1F535','1F7E3','1F7E4','26AB','26AA','1F7E5','1F7E7','1F7E8','1F7E9','1F7E6','1F7EA','1F7EB','2B1B','2B1C','25FC','25FB','25FE','25FD','25AA','25AB','1F536','1F537','1F538','1F539','1F53A','1F53B','1F4A0','1F518','1F533','1F532','1F3C1','1F6A9','1F38C','1F3F4','1F3F3','1F3F3','FE0F','200D','1F308','1F3F4','200D','2620','FE0F','1F1E6','1F1E8','1F1E6','1F1E9','1F1E6','1F1EA','1F1E6','1F1EB','1F1E6','1F1EC','1F1E6','1F1EE','1F1E6','1F1F1','1F1E6','1F1F2','1F1E6','1F1F4','1F1E6','1F1F6','1F1E6','1F1F7','1F1E6','1F1F8','1F1E6','1F1F9','1F1E6','1F1FA','1F1E6','1F1FC','1F1E6','1F1FD','1F1E6','1F1FF','1F1E7','1F1E6','1F1E7','1F1E7','1F1E7','1F1E9','1F1E7','1F1EA','1F1E7','1F1EB','1F1E7','1F1EC','1F1E7','1F1ED','1F1E7','1F1EE','1F1E7','1F1EF','1F1E7','1F1F1','1F1E7','1F1F2','1F1E7','1F1F3','1F1E7','1F1F4','1F1E7','1F1F6','1F1E7','1F1F7','1F1E7','1F1F8','1F1E7','1F1F9','1F1E7','1F1FB','1F1E7','1F1FC','1F1E7','1F1FE','1F1E7','1F1FF','1F1E8','1F1E6','1F1E8','1F1E8','1F1E8','1F1E9','1F1E8','1F1EB','1F1E8','1F1EC','1F1E8','1F1ED','1F1E8','1F1EE','1F1E8','1F1F0','1F1E8','1F1F1','1F1E8','1F1F2','1F1E8','1F1F3','1F1E8','1F1F4','1F1E8','1F1F5','1F1E8','1F1F7','1F1E8','1F1FA','1F1E8','1F1FB','1F1E8','1F1FC','1F1E8','1F1FD','1F1E8','1F1FE','1F1E8','1F1FF','1F1E9','1F1EA','1F1E9','1F1EC','1F1E9','1F1EF','1F1E9','1F1F0','1F1E9','1F1F2','1F1E9','1F1F4','1F1E9','1F1FF','1F1EA','1F1E6','1F1EA','1F1E8','1F1EA','1F1EA','1F1EA','1F1EC','1F1EA','1F1ED','1F1EA','1F1F7','1F1EA','1F1F8','1F1EA','1F1F9','1F1EA','1F1FA','1F1EB','1F1EE','1F1EB','1F1EF','1F1EB','1F1F0','1F1EB','1F1F2','1F1EB','1F1F4','1F1EB','1F1F7','1F1EC','1F1E6','1F1EC','1F1E7','1F1EC','1F1E9','1F1EC','1F1EA','1F1EC','1F1EB','1F1EC','1F1EC','1F1EC','1F1ED','1F1EC','1F1EE','1F1EC','1F1F1','1F1EC','1F1F2','1F1EC','1F1F3','1F1EC','1F1F5','1F1EC','1F1F6','1F1EC','1F1F7','1F1EC','1F1F8','1F1EC','1F1F9','1F1EC','1F1FA','1F1EC','1F1FC','1F1EC','1F1FE','1F1ED','1F1F0','1F1ED','1F1F2','1F1ED','1F1F3','1F1ED','1F1F7','1F1ED','1F1F9','1F1ED','1F1FA','1F1EE','1F1E8','1F1EE','1F1E9','1F1EE','1F1EA','1F1EE','1F1F1','1F1EE','1F1F2','1F1EE','1F1F3','1F1EE','1F1F4','1F1EE','1F1F6','1F1EE','1F1F7','1F1EE','1F1F8','1F1EE','1F1F9','1F1EF','1F1EA','1F1EF','1F1F2','1F1EF','1F1F4','1F1EF','1F1F5','1F1F0','1F1EA','1F1F0','1F1EC','1F1F0','1F1ED','1F1F0','1F1EE','1F1F0','1F1F2','1F1F0','1F1F3','1F1F0','1F1F5','1F1F0','1F1F7','1F1F0','1F1FC','1F1F0','1F1FE','1F1F0','1F1FF','1F1F1','1F1E6','1F1F1','1F1E7','1F1F1','1F1E8','1F1F1','1F1EE','1F1F1','1F1F0','1F1F1','1F1F7','1F1F1','1F1F8','1F1F1','1F1F9','1F1F1','1F1FA','1F1F1','1F1FB','1F1F1','1F1FE','1F1F2','1F1E6','1F1F2','1F1E8','1F1F2','1F1E9','1F1F2','1F1EA','1F1F2','1F1EB','1F1F2','1F1EC','1F1F2','1F1ED','1F1F2','1F1F0','1F1F2','1F1F1','1F1F2','1F1F2','1F1F2','1F1F3','1F1F2','1F1F4','1F1F2','1F1F5','1F1F2','1F1F6','1F1F2','1F1F7','1F1F2','1F1F8','1F1F2','1F1F9','1F1F2','1F1FA','1F1F2','1F1FB','1F1F2','1F1FC','1F1F2','1F1FD','1F1F2','1F1FE','1F1F2','1F1FF','1F1F3','1F1E6','1F1F3','1F1E8','1F1F3','1F1EA','1F1F3','1F1EB','1F1F3','1F1EC','1F1F3','1F1EE','1F1F3','1F1F1','1F1F3','1F1F4','1F1F3','1F1F5','1F1F3','1F1F7','1F1F3','1F1FA','1F1F3','1F1FF','1F1F4','1F1F2','1F1F5','1F1E6','1F1F5','1F1EA','1F1F5','1F1EB','1F1F5','1F1EC','1F1F5','1F1ED','1F1F5','1F1F0','1F1F5','1F1F1','1F1F5','1F1F2','1F1F5','1F1F3','1F1F5','1F1F7','1F1F5','1F1F8','1F1F5','1F1F9','1F1F5','1F1FC','1F1F5','1F1FE','1F1F6','1F1E6','1F1F7','1F1EA','1F1F7','1F1F4','1F1F7','1F1F8','1F1F7','1F1FA','1F1F7','1F1FC','1F1F8','1F1E6','1F1F8','1F1E7','1F1F8','1F1E8','1F1F8','1F1E9','1F1F8','1F1EA','1F1F8','1F1EC','1F1F8','1F1ED','1F1F8','1F1EE','1F1F8','1F1EF','1F1F8','1F1F0','1F1F8','1F1F1','1F1F8','1F1F2','1F1F8','1F1F3','1F1F8','1F1F4','1F1F8','1F1F7','1F1F8','1F1F8','1F1F8','1F1F9','1F1F8','1F1FB','1F1F8','1F1FD','1F1F8','1F1FE','1F1F8','1F1FF','1F1F9','1F1E6','1F1F9','1F1E8','1F1F9','1F1E9','1F1F9','1F1EB','1F1F9','1F1EC','1F1F9','1F1ED','1F1F9','1F1EF','1F1F9','1F1F0','1F1F9','1F1F1','1F1F9','1F1F2','1F1F9','1F1F3','1F1F9','1F1F4','1F1F9','1F1F7','1F1F9','1F1F9','1F1F9','1F1FB','1F1F9','1F1FC','1F1F9','1F1FF','1F1FA','1F1E6','1F1FA','1F1EC','1F1FA','1F1F2','1F1FA','1F1F3','1F1FA','1F1F8','1F1FA','1F1FE','1F1FA','1F1FF','1F1FB','1F1E6','1F1FB','1F1E8','1F1FB','1F1EA','1F1FB','1F1EC','1F1FB','1F1EE','1F1FB','1F1F3','1F1FB','1F1FA','1F1FC','1F1EB','1F1FC','1F1F8','1F1FD','1F1F0','1F1FE','1F1EA','1F1FE','1F1F9','1F1FF','1F1E6','1F1FF','1F1F2','1F1FF','1F1FC','1F3F4','E0067','E0062','E0065','E006E','E0067','E007F','1F3F4','E0067','E0062','E0073','E0063','E0074','E007F','1F3F4','E0067','E0062','E0077','E006C','E0073','E007F' );
return preg_match( '/[\x{' . implode( '}\x{', $unicodes ) . '}]/u', $string ) ? true : false;
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$message_id = $message->message_id;
$text = $message->text;
$DevId = "$admin";
$fromid = $update->callback_query->from->id;
$data = $update->callback_query->data;
$message_id2 = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$bot = '@'.bot('getme',['bot'])->result->username;
$temp = json_decode(file_get_contents('temp.json'),true);
$msg = json_decode(file_get_contents('msgs.json'),true);
$like = json_decode(file_get_contents("like.json"),true);
$settings = json_decode(file_get_contents("settings.json"),true);
if ($message->photo or $message->document or $message->video or $message->voice or $message->audio) {
$text = $message->caption;
}
if (!file_exists('temp.json')) {
file_put_contents("temp.json", '{}');
}if (!file_exists('msgs.json')) {
file_put_contents("msgs.json", '{"last":1}');
}
if($message and !in_array($from_id, $settings["member"])){
$settings['member'][] = "$from_id";
file_put_contents("settings.json",json_encode($settings));
}
if($message and $from_id == $DevId and !in_array($from_id, $settings["admins"])){
$settings["admins"][] = "$DevId"; 
file_put_contents("settings.json",json_encode($settings,true)); 
}
$j = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=".$settings['ch']."&user_id=".$from_id);
if($message && (strpos($j,'"status":"left"') or strpos($j,'"Bad Request: USER_ID_INVALID"') or strpos($j,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"قم بالاشتراك  في قناة البوت ".$settings['ch']." اولا ثم  ارسل /start",'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,'disable_web_page_preview'=>true,
]);return false;}
$mem = count($settings['member'])+0;
if($text =='/start' and !in_array($from_id, $settings["admins"])){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"اهلا  بك ،البوت خاص يمكنك استخدتمه في حاله وحده ، وهي ان يقوم المطور برفعك ادمن في البوت :

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- تابع قناة البوت 📒",'url'=>"t.me/wwttw"]],
]])]);}

if($text =='/start' and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اهلا بكم اعزائي الادمنيه في قائمه تشغيل البوت استخدمو الكيبورد اسفل 
ملاحضه اوامر اضاففه وحذف الادمن للمطور الاساسي فقط",
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف التخزين السابق','callback_data'=>'delson']],
[['text'=>'قسم الادمنيه','callback_data'=>'admins'],['text'=>'عدد المشتركين'.$mem,'callback_data'=>'mem'],['text'=>'الاشتراك الاجباري','callback_data'=>'Chnell']],
[['text'=>'اضف نقاط','callback_data'=>'adRu'],['text'=>'حذف نقاط','callback_data'=>'DerYh']],
[['text'=>'انشاء تصويت','callback_data'=>'cr']],
]])
]);
unset($settings[$chat_id]['set']);
file_put_contents("settings.json",json_encode($settings));
}

if($data =='back' and in_array($fromid, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"اهلا بكم اعزائي الادمنيه في قائمه تشغيل البوت استخدمو الكيبورد اسفل 
ملاحضه اوامر اضاففه وحذف الادمن للمطور الاساسي فقط",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف التخزين السابق','callback_data'=>'delson']],
[['text'=>'قسم الادمنيه','callback_data'=>'admins'],['text'=>'عدد المشتركين'.$mem,'callback_data'=>'mem'],['text'=>'الاشتراك الاجباري','callback_data'=>'Chnell']],
[['text'=>'اضف نقاط','callback_data'=>'adRu'],['text'=>'حذف نقاط','callback_data'=>'DerYh']],
[['text'=>'انشاء تصويت','callback_data'=>'cr']],
]])
]);
unset($settings[$chat_id]['set']);
file_put_contents("settings.json",json_encode($settings));
}
if($data =='delson' and in_array($fromid, $settings["admins"])){
unlink("like.json");
unlink("like.json");
unlink("temp.json");
unlink("msgs.json");
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"تم تصفيه الخزن",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
if (!file_exists('temp.json')) {
file_put_contents("temp.json", '{}');
}if (!file_exists('msgs.json')) {
file_put_contents("msgs.json", '{"last":1}');
}
}
if($data =='DerYh' and in_array($fromid, $settings["admins"])){
$settings[$chat_id2]['set'] = "DerYh";
file_put_contents("settings.json",json_encode($settings));
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"قم بأرسال رقم كود المشترك الان + عدد النقاط بالشكل 
رقم الكود:عدد النقاط
1:100",
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
$Re = explode(':', $text);
if($text and $settings[$chat_id]['set'] =="DerYh"){
$like['like'][$Re[0]] = ($like['like'][$Re[0]]-$Re[1]);
file_put_contents("like.json",json_encode($like,128|32|256));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"*تم حذف النقاط بنجاح\n*النقاط الان _".$like['like'][$Re[0]]."_",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"back"]],
]])
]);
unset($settings[$chat_id]['set']);
file_put_contents("settings.json",json_encode($settings));
}
$cx = explode(':', $text);
if($text and $settings[$chat_id]['set'] =="adRu"){
$like['like'][$cx[0]] = ($like['like'][$cx[0]]+$cx[1]);
file_put_contents("like.json",json_encode($like,128|32|256));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"*تم اضافه النقاط بنجاح\n*النقاط الان _".$like['like'][$cx[0]]."_",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"back"]],
]])
]);
unset($settings[$chat_id]['set']);
file_put_contents("settings.json",json_encode($settings));
}
if($data =='adRu' and in_array($fromid, $settings["admins"])){
$settings[$chat_id2]['set'] = "adRu";
file_put_contents("settings.json",json_encode($settings));
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"قم بأرسال رقم كود المشترك الان + عدد النقاط بالشكل 
رقم الكود:عدد النقاط
1:100",
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
if($data =='mem' and in_array($fromid, $settings["admins"])){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عدد مشتركين البوت هو $mem",
'show_alert'=>true,
]);
}
if($data =='admins' and in_array($fromid, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>" استخدم الكيبورد اسفل",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة الادمنيه",'callback_data'=>"listadmins"]],
[['text'=>"حذف ادمن",'callback_data'=>"deladmin"],['text'=>"اضف ادمن",'callback_data'=>"addadmin"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
if($data =='listadmins' and !$settings['admins']){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"لم يتم رفع اي ادمن",
'show_alert'=>true,
]);
}
if($data =='listadmins' and $settings['admins']){
$keyboard["inline_keyboard"]=[];
for ($i=0; $i < count($settings['admins']); $i++) {
$Info = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$settings["admins"][$i]));
$Name = $Info->result->first_name;
$Userame = $Info->result->username;
$keyboard["inline_keyboard"][$i] = [['text'=>"- ".$Name,'url'=>"tg://user?id=".$settings['admins'][$i]],['text'=>"حذف",'callback_data'=>'id#'.$settings['admins'][$i]]];
}
$keyboard["inline_keyboard"][]=[['text'=>"• رجوع '🔙،",'callback_data'=>'back']];
$reply_markup = json_encode($keyboard); 
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"ادمنيه البوت",'parse_mode'=>"Markdown",
'reply_markup'=>$reply_markup,
]);
}
$da = explode('#', $data);
if($da[0] == "id" and $chat_id2 == $DevId){
$key = array_search($da[1],$settings["admins"]);
unset($settings["admins"][$key]);
$settings["admins"] = array_values($settings["admins"]);
file_put_contents("settings.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم حذف الادمن",
'show_alert'=>true,
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>" استخدم الكيبورد اسفل",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة الادمنيه",'callback_data'=>"listadmins"]],
[['text'=>"حذف ادمن",'callback_data'=>"deladmin"],['text'=>"اضف ادمن",'callback_data'=>"addadmin"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
$da = explode('#', $data);
if($da[0] == "id" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $DevId){
$key = array_search($da[1],$settings["admins"]);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا لاتستطيع حذف الادمنيه",
'show_alert'=>true,
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>" استخدم الكيبورد اسفل",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة الادمنيه",'callback_data'=>"listadmins"]],
[['text'=>"حذف ادمن",'callback_data'=>"deladmin"],['text'=>"اضف ادمن",'callback_data'=>"addadmin"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
if($data == "addadmin" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $DevId){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
]);
}
if($data == "deladmin" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $DevId){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
]);
}
if($data == "addadmin" and $chat_id2 == $DevId){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"*ارسل ايدي الشخص ليتم رفعه ادمن في البوت*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر",'callback_data'=>"admins"]],
]])
]);
$settings[$chat_id2]['set'] = "addadmin";
file_put_contents("settings.json",json_encode($settings));
}
if($text and $settings[$chat_id]['set'] =="addadmin" and $chat_id == $DevId){
$settings['admins'][] = $text;
file_put_contents("settings.json",json_encode($settings));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>" *تم رفع العضو بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"admins"]],
]])
]);
unset($settings[$chat_id]['set']);
file_put_contents("settings.json",json_encode($settings));
bot('sendmessage',[
'chat_id'=>$text,
'text'=>"*تم رفعك في قائمة الادمنيه بواسطة مطور البوت*",'parse_mode'=>"Markdown",
]);
}
if($data =="deladmin" and $chat_id2 == $DevId){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>" *ارسل ايدي الشخص ليتم حذفه من قائمه الادمنيه في البوت*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"admins"]],
]])
]);
$settings[$chat_id2]['set'] = "deladmin";
file_put_contents("settings.json",json_encode($settings));
}
if($text and $settings[$chat_id]['set'] =="deladmin" and $chat_id == $DevId){
$key = array_search($text,$settings["admins"]);
unset($settings["admins"][$key]);
$settings["admins"] = array_values($settings["admins"]);
file_put_contents("settings.json",json_encode($settings,true));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>" *تم حذف الادمن بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"admins"]],
]])
]);
unset($settings[$chat_id]['set']);
file_put_contents("settings.json",json_encode($settings));
bot('SendMessage',[
'chat_id'=>$text,
'text'=>" *تم حذفك من قائمة الادمنيه بواسطة المطور*",'parse_mode'=>"Markdown",
]);
}
if($data == "Chnell" and in_array($chat_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"*اهلا بك يوجد قسمين للاجباري . الاول لخاص البوت ويستطيع اضافته المطور فقط ، والثاني للتصويت ويمكن للادمن اضافه القناة ايضا*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"جباري الخاص",'callback_data'=>"Chnel"],['text'=>"اجباري التصويت",'callback_data'=>"Zscl"]],
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
if($data == "Chnel" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $DevId){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
'show_alert'=>true,
]);
}
if($data == "Chnel" and $chat_id2 == $DevId){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"*ارسل معرف القناة مع @ كمثال  @Vhhhhh*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
$settings[$chat_id2]['set'] = "addch";
file_put_contents("settings.json",json_encode($settings));
}
if($text and $settings[$chat_id]['set'] =="addch" and $chat_id == $DevId){
$settings['ch'] = $text;
file_put_contents("settings.json",json_encode($settings));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>" *تم حفظ القناة ،قم برفع البوت  مشرف فيها* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
unset($settings[$chat_id]['set']);
unset($settings[$chat_id]);
file_put_contents("settings.json",json_encode($settings));
}
if($data == "Zscl" and in_array($fromid, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"*ارسل معرف القناة مع @ كمثال  @Vhhhhh*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
$settings[$chat_id2]['set'] = "Zscl";
file_put_contents("settings.json",json_encode($settings));
}
if($text and $settings[$chat_id]['set'] =="Zscl" and in_array($chat_id, $settings["admins"])){
$settings['Zscl'] = $text;
file_put_contents("settings.json",json_encode($settings));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>" *تم حفظ القناة ،قم برفع البوت  مشرف فيها* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
unset($settings[$chat_id]['set']);
unset($settings[$chat_id]);
file_put_contents("settings.json",json_encode($settings));
}
if ($data == 'cr') {
$temp[$chat_id2]['mode'] = 'head';
bot('editMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- رساله { نص ، ملصق ، صوره ، فديو ، مقطع صوتي ، ملف ، صوره بالكتابه ، صوره متحركه ، كليشه",
]);
 file_put_contents('temp.json', json_encode($temp));
}
if ($temp[$chat_id]['mode'] == 'head'){
if ($message->text == "الغاء") {
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تم الغاء الاستمراريه بنجاح",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف التخزين السابق','callback_data'=>'delson']],
[['text'=>'قسم الادمنيه','callback_data'=>'admins'],['text'=>'عدد المشتركين'.$mem,'callback_data'=>'mem'],['text'=>'الاشتراك الاجباري','callback_data'=>'Chnell']],
[['text'=>'اضف نقاط','callback_data'=>'adRu'],['text'=>'حذف نقاط','callback_data'=>'DerYh']],
[['text'=>'انشاء تصويت','callback_data'=>'cr']],
]])
]);
$temp[$chat_id]['type'] = null;
$temp[$chat_id]['mode'] = 'null';
$temp[$chat_id]['text'] = null;  
$temp[$chat_id]['caption'] = null;
$temp[$chat_id]['file_id']= null;
$temp[$chat_id]["im"] = null;
$temp[$chat_id]['mode'] = 'null';
file_put_contents('temp.json', json_encode($temp));
file_put_contents('msgs.json', json_encode($msg));
}
if ($message->text != "الغاء") { 
if ($message->text != "/start"){
$temp[$chat_id]['type'] = 'text';
$temp[$chat_id]['text'] = $text;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
}
if ($message->photo) {
$temp[$chat_id]['type'] = 'photo';
$temp[$chat_id]['caption'] = $text;
$temp[$chat_id]['file_id'] = $message->photo[0]->file_id;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
if ($message->video) {
$temp[$chat_id]['type'] = 'video';
$temp[$chat_id]['caption'] = $text;
$temp[$chat_id]['file_id'] = $message->video->file_id;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
if ($message->voice) {
$temp[$chat_id]['type'] = 'voice';
$temp[$chat_id]['caption'] = $text;
$temp[$chat_id]['file_id'] = $message->voice->file_id;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
if ($message->audio) {
$temp[$chat_id]['type'] = 'audio';
$temp[$chat_id]['caption'] = $text;
$temp[$chat_id]['file_id'] = $message->audio->file_id;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
 if ($message->sticker) {
$temp[$chat_id]['type'] = 'sticker';
$temp[$chat_id]['caption'] = $text;
$temp[$chat_id]['file_id'] = $message->sticker->file_id;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
if ($message->document) {
$temp[$chat_id]['type'] = 'doc';
$temp[$chat_id]['caption'] = $text;
$temp[$chat_id]['file_id'] = $message->document->file_id;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"قم الان بأرسال الاموجي",
]);
$temp[$chat_id]['f'] = 'k';
$temp[$chat_id]['mode'] = null;
file_put_contents('temp.json', json_encode($temp));
}
}
if ($text and $temp[$chat_id]['f'] == 'k'){
if(has_emojis($text) == true){
$temp[$chat_id]['im'] = $text;
file_put_contents('temp.json', json_encode($temp));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>'- انتظر قليلا جار اكمال الكود . . .
- الكود للمشترك :'.$temp[$chat_id]['text']."
- ارسل كليشه المشترك اخر او ارسل كلمه الغاء",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"الغاء"]],
],
'resize_keyboard'=>true
]), 
]);
$temp[$chat_id]['f'] = 'null';
file_put_contents('temp.json', json_encode($temp));
if($temp[$chat_id]['type'] == 'text') {
$msg[$msg['last'] + 1]['type'] = 'text';
$msg[$msg['last'] + 1]['text'] = $temp[$chat_id]['text'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],				
]])
]);
}
if ($temp[$chat_id]['type'] == 'photo') {
$msg[$msg['last'] + 1]['type'] = 'photo';
$msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id]['file_id'];
$msg[$msg['last'] + 1]['caption'] = $temp[$chat_id]['caption'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],]])
]);
}
if ($temp[$chat_id]['type'] == 'video') {
$msg[$msg['last'] + 1]['type'] = 'video';
$msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id]['file_id'];
$msg[$msg['last'] + 1]['caption'] = $temp[$chat_id]['caption'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[

[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],]])
]);
}
if ($temp[$chat_id]['type'] == 'audio') {
$msg[$msg['last'] + 1]['type'] = 'audio';
$msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id]['file_id'];
$msg[$msg['last'] + 1]['caption'] = $temp[$chat_id]['caption'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[

[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],]])
]);
}
if ($temp[$chat_id]['type'] == 'voice') {
$msg[$msg['last'] + 1]['type'] = 'voice';
$msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id]['file_id'];
$msg[$msg['last'] + 1]['caption'] = $temp[$chat_id]['caption'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[

[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],]])
]);
}
if ($temp[$chat_id]['type'] == 'sticker') {
$msg[$msg['last'] + 1]['type'] = 'sticker';
$msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id]['file_id'];
$msg[$msg['last'] + 1]['caption'] = $temp[$chat_id]['caption'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[

[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],]])
]);
}
if ($temp[$chat_id]['type'] == 'doc'){
$msg[$msg['last'] + 1]['type'] = 'doc';
$msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id]['file_id'];
$msg[$msg['last'] + 1]['caption'] = $temp[$chat_id]['caption'];
$msg[$msg['last'] + 1]["im"] = $temp[$chat_id]['im'];
$msg['last'] = $msg['last'] + 1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$bot.' '.$msg['last'],
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>' مشاركة','switch_inline_query'=>$msg['last']]],]])
]);
}
$temp[$chat_id]['type'] = null;
$temp[$chat_id]['mode'] = 'head';
$temp[$chat_id]['text'] = null;  
$temp[$chat_id]['caption'] = null;
$temp[$chat_id]['file_id']= null;
$temp[$chat_id]["im"] = null;
$temp[$chat_id]['mode'] = 'head';
file_put_contents('temp.json', json_encode($temp));
file_put_contents('msgs.json', json_encode($msg));
}
}
$inline = $update->inline_query->query;
if ($inline) {
if(!$msg[$inline]['im']){
$imo = "ْ";
}elseif($msg[$inline]['im']){
$imo = $msg[$inline]['im'];
}
$type = $msg[$inline]['type'];
if ($type == 'text') {
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
 'input_message_content'=>['parse_mode'=>'HTML','message_text'=>$msg[$inline]['text']],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
if ($type == 'voice') {
if($msg[$inline]['caption'] != null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'voice',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'voice_file_id'=>$msg[$inline]['file_id'],
'caption'=>$msg[$inline]['caption'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
if($msg[$inline]['caption'] == null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'voice',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'voice_file_id'=>$msg[$inline]['file_id'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
}

if ($type == 'photo') {
if($msg[$inline]['caption'] != null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'photo',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'photo_file_id'=>$msg[$inline]['file_id'],
'caption'=>$msg[$inline]['caption'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
if($msg[$inline]['caption'] == null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'photo',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'photo_file_id'=>$msg[$inline]['file_id'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
}

if ($type == 'sticker') {
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'sticker',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'sticker_file_id'=>$msg[$inline]['file_id'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}

if ($type == 'audio') {
if($msg[$inline]['caption'] != null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'audio',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'audio_file_id'=>$msg[$inline]['file_id'],
'caption'=>$msg[$inline]['caption'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
if($msg[$inline]['caption'] == null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'audio',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'audio_file_id'=>$msg[$inline]['file_id'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
}

if ($type == 'video') {
if($msg[$inline]['caption'] != null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'video',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'video_file_id'=>$msg[$inline]['file_id'],
'caption'=>$msg[$inline]['caption'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
if($msg[$inline]['caption'] == null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'video',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'video_file_id'=>$msg[$inline]['file_id'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
}
 if ($type == 'doc') {
if($msg[$inline]['caption'] != null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'document',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'document_file_id'=>$msg[$inline]['file_id'],
'caption'=>$msg[$inline]['caption'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
if($msg[$inline]['caption'] == null){
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' => json_encode([[
'type'=>'document',
'id'=>base64_encode(rand(5,555)),
'title'=>"- اضغط لارسال المنشور ،",
'document_file_id'=>$msg[$inline]['file_id'],
'input_message_content'=>['parse_mode'=>'HTML'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>$imo. $like['like'][$inline], 'callback_data'=>"like(".$inline]],
]]
]])
]);
}
}
}
$v = explode('(', $data);
if(!$msg[$v[1]]['im']){
$imoo = "ْ";
}elseif($msg[$v[1]]['im']){
$imoo = $msg[$v[1]]['im'];
}
$tc = $update->message->chat->type;
$HL = $settings['Zscl'];
$j2 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$HL&user_id=".$fromid);
$Spe2 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$HL&user_id=".$fromid);
if($v[0] == "like"){ 
if($settings['Zscl'] != null && (strpos($Spe2,'"status":"left"') or strpos($Spe2,'"Bad Request: USER_ID_INVALID"') or strpos($Spe2,'"status":"kicked"'))!== false or (strpos($j2,'"status":"left"') or strpos($j2,'"Bad Request: USER_ID_INVALID"') or strpos($j2,'"status":"kicked"'))!== false){
if($tc != 'private'){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>" اشترك هنا اولا $HL",
'show_alert'=>true,
]);return false;}
}else{
if(!in_array($fromid, $like['ids'][$v[1]])) { 
$like['like'][$v[1]] = ($like['like'][$v[1]]+1);
file_put_contents("like.json",json_encode($like,128|32|256));
bot('editMessageReplyMarkup',[
'chat_id'=>$chat_id2,
'inline_message_id'=>$update->callback_query->inline_message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>$imoo.$like['like'][$v[1]], 'callback_data'=>"like(".$v[1]]],
]])
]);
$like['ids'][$v[1]][] = "$fromid";
file_put_contents("like.json",json_encode($like,128|32|256));
}else{
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم التصويت بالفعل",
'show_alert'=>true,
]);
}
}}