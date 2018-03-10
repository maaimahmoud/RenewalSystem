<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailingSystemViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //view to return client service id with the days should be remind with the mail 
        DB::statement("CREATE VIEW TimetoMail AS
                        SELECT mcv.client_services_id AS client_services_id , mm.days AS days_remain_to_mail
                        FROM mailing_method_clinet_services AS mcv
                        INNER JOIN mailing_methods AS mm ON mcv.mailing_methods_id = mm.id;
                        ");
        
        //view to compain client_service with payment time to tiples expected to mailled
        DB::statement("CREATE VIEW client_service_day AS
                        SELECT cs.* , pm.days AS payment_days
                        FROM client_services AS cs
                        INNER JOIN payment_methods AS pm ON cs.payment_method = pm.id
                        WHERE cs.end_time > CURTIME() AND cs.balance < cs.required_money AND pm.days > DATEDIFF(CURTIME(),cs.updated_at);
                        ");
        
        //view to get client id and service id and days remain to next payment to send mail
        DB::statement("CREATE VIEW client_service_to_mail AS
                        SELECT  csd.client_id,csd.service_id, tm.days_remain_to_mail
                        FROM client_service_day AS csd
                        INNER JOIN TimetoMail AS tm ON tm.client_services_id = csd.id
                        WHERE csd.payment_days - DATEDIFF(CURTIME(),csd.updated_at) = tm.days_remain_to_mail;
                        ");
        
        //view to get essintial information that will be included on the mail
        // DB::statement("SELECT  csd.client_id,csd.service_id, tm.days_remain_to_mail
        //                 FROM client_service_to_mail AS csm
        //                 INNER JOIN TimetoMail AS tm ON tm.client_services_id = csd.id
        //                 WHERE csd.payment_days - DATEDIFF(CURTIME(),csd.updated_at) = tm.days_remain_to_mail;
        //                 ");
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW TimetoMail;");
        DB::statement("DROP VIEW client_service_day;");
        DB::statement("DROP VIEW client_service_to_mail;");
    }
}
