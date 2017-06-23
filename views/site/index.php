<?php

namespace app\controllers;

use Yii;
use app\models\Course;
use app\models\FundingSource;
use app\models\Events;
use app\models\Center;
use app\models\Student;
use app\models\Location;
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    
    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO -->
    <meta name="description" content="150 words">
    <meta name="author" content="uipasta">
    <meta name="url" content="http://www.yourdomainname.com">
    <meta name="copyright" content="company name">
    <meta name="robots" content="index,follow">
    
    
    <title>WebRes - Personal Resume Template</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="images/favicon/apple-touch-icon.png">
    
    <!-- All CSS Plugins -->
    <link rel="stylesheet" type="text/css" href="css/plugin.css">
    
    <!-- Main CSS Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- Google Web Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
    
 </head>
<div class="site-index">
  <body>
    
	<!-- Preloader Start -->
    <div class="preloader">
	  <p>Loading...</p>
     </div>
     <!-- Preloader End -->

    
    

     <!-- Menu Section End -->  
    
    
    <!-- Home Section Start -->
<!--<div class="home-page-title">האגודה לקידום החינוך</div>-->
<?php if (!Yii::$app->user->isGuest):?>

   <!--<section class="home-section">
        <div class="container">
            <div class="row">
                 <div class="col-sm-offset-2 col-md-4 col-sm-6 margin-left-setting">
                 
                     <div class="table-responsive">
                         <div class="hello-user">
                            <div class="hello-user1">שלום </div>
                            <div class="hello-user2"><?=Yii::$app->user->identity->firstname?> </div>
                         </div>
                         <table class="table">
							<tr>
							    <td>שם פרטי</td>
								<td><?=Yii::$app->user->identity->firstname?></td>
							 </tr>
                             <tr>
							    <td>שם משפחה</td>
								<td><?=Yii::$app->user->identity->lastname?></td>
							 </tr>
                             <tr>
								<td>אימייל</td>
								<td><?=Yii::$app->user->identity->email?></td>
							</tr>
							<tr>
								<td>מס נייד</td>
								<td><?=Yii::$app->user->identity->phone?></td>
							 </tr>
                            <tr>
							</tr>
						</table>
					  </div>
                     </div>
                   </div>
                 
            </div>

        </section>-->
        <?php endif;?>

        <!-- Home Section End -->
         <!-- ------------------------------------ -->
<div class="header-homepage">
   <!-- MAIN IMAGE -->
		<div class="slotholder" style=" top: 0px; left: 0px; z-index: 0; width: 100%; height: 100%; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);"><!--Runtime Modification - Img tag is Still Available for SEO Goals in Source - <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/08/lr-5243.jpg" alt="נערות הולכות בבית הספר" title="נערות הולכות בבית הספר" width="1920" height="800" data-bgposition="center top" data-kenburns="on" data-duration="5000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="110" data-rotatestart="0" data-rotateend="0" data-offsetstart="350 -100" data-offsetend="-350 100" class="rev-slidebg defaultimg" data-no-retina="">--><div class="tp-dottedoverlay twoxtwo"></div><div><img class="tp-kbimg" src="http://www.kidum-edu.org.il/wp-content/uploads/2016/08/lr-5243.jpg" style="height: 450px; width: 1392px; transform: translate3d(0px, 0px, 0px) scale(1.06294, 1.06294); transform-origin: 0% 0% 0px;" width="1920" height="800"></div></div>
		<!-- LAYERS -->

		<!-- LAYER NR. 1 -->
		<div class="tp-parallax-wrap" style="position: absolute; visibility: visible; left: 1015px; top: 386px; z-index: 5;"><div class="tp-loop-wrap" style="position:absolute;"><div class="tp-mask-wrap" style="position: absolute; overflow: visible; height: auto; width: auto;"><div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-1-layer-3" data-x="center" data-hoffset="" data-y="386" data-width="['750']" data-height="['175']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:300;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="500" data-responsive_offset="on" style="z-index: 5; background-color: rgba(0, 109, 100, 0.4); border-color: rgba(0, 0, 0, 0.5); visibility: inherit; transition: none; line-height: 24px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 1px; font-weight: 200; font-size: 21px; white-space: nowrap; min-height: 175px; min-width: 750px; max-height: 175px; max-width: 750px; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;"> </div></div></div></div>

		<!-- LAYER NR. 2 -->
		<div class="tp-parallax-wrap" style="position: absolute; visibility: visible; left: 903px; top: 429px; z-index: 6;"><div class="tp-loop-wrap" style="position:absolute;"><div class="tp-mask-wrap" style="position: absolute; overflow: visible; height: auto; width: auto;"><div class="tp-caption   tp-resizeme" id="slide-1-layer-1" data-x="center" data-hoffset="" data-y="429" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:300;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 22px; font-weight: 600; color: rgb(255, 255, 255); visibility: inherit; transition: none; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 1px; min-height: 0px; min-width: 0px; max-height: none; max-width: none; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;"> האגודה לקידום החינוך </div></div></div></div>

		<!-- LAYER NR. 3 -->
		<div class="tp-parallax-wrap" style="position: absolute; visibility: visible; left: 810px; top: 497px; z-index: 7;"><div class="tp-loop-wrap" style="position:absolute;"><div class="tp-mask-wrap" style="position: absolute; overflow: visible; height: auto; width: auto;"><div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="center" data-hoffset="" data-y="497" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:300;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap; font-size: 55px; line-height: 22px; font-weight: 400; color: rgb(255, 255, 255); visibility: inherit; transition: none; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 1px; min-height: 0px; min-width: 0px; max-height: none; max-width: none; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;"> " מצויינות ומנהיגות "</div></div></div></div>
	</li>
    </div>
	
            <!-- ------------------------------------ -->
        
     <!-- Services Start -->
    <section id="services" class="services-section section-space-padding">
        <div class="container">
           <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>מוסדות האגודה לקידום החינוך</h2>
                          <div class="divider dark">
						   <i class="icon-drop"></i>
						 </div>
                    </div>
                </div>
            </div>
            
            <div class="row margin-top-30">
            <a href="/a_p/web/teacher">
                <div class="col-md-4 col-sm-6">
                    <div class="services-detail">
                        <i class="fa fa-user-o color-1"></i>
                        <h3> מורים</h3>
                        <hr>
                    </div>
                </div>
            </a>

            <a href="/a_p/web/supervisor">
                <div class="col-md-4 col-sm-6">
                    <div class="services-detail">
                        <i class="fa fa-user-o color-2"></i>
                        <h3>רכזים</h3>
                        <hr>
                    </div>
                </div>
            </a>

            <a href="/a_p/web/supervisor">
                <div class="col-md-4 col-sm-6">
                    <div class="services-detail">
                        <i class="fa fa-user-o color-3"></i>
                        <h3>מנהלים</h3>
                        <hr>
                    </div>
                </div>
            </a>

			</div>
            
            </div>
        </div>
    </section>
    <!-- Services End -->    
 
     <!-- Portfolio Start -->
    <section id="portfolio" class="portfolio section-space-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>קצת מאיתנו</h2>
                          <div class="divider dark">
						   <i class="icon-picture"></i>
						   </div>
                        <p></p>
                    </div>
                </div>
            </div>
            
            <!--<div class="row">
              <div class="col-md-2">
                <ul class="portfolio">
                    <li class="filter" data-filter="all">all</li>
                    <li class="filter" data-filter=".apps">apps</li>
                    <li class="filter" data-filter=".mockups">mockups</li>
                    <li class="filter" data-filter=".wordpress">wordpress</li>
                </ul>
              </div>-->
            
           
                <div class="portfolio-inner margin-top-30">
                
                
                    <div class="col-md-4 col-sm-6 col-xs-12 mix apps">
                        <div class="item">
                            <a href="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/LR-55r.jpg" class="portfolio-popup" title="Project Title">
                                <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/LR-55r.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12 mix mockups">
                        <div class="item">
                            <a href="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/lr-5311.jpg" class="portfolio-popup" title="Project Title">
                                <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/lr-5311.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12 mix apps">
                        <div class="item">
                            <a href="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/P2090379r-1.jpg" class="portfolio-popup" title="Project Title">
                                <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/P2090379r-1.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12 mix mockups wordpress">
                        <div class="item">
                            <a href="http://www.kidum-edu.org.il/wp-content/uploads/2016/10/lr-62.jpg" class="portfolio-popup" title="Project Title">
                                <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/10/lr-62.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12 mix wordpress apps">
                        <div class="item">
                            <a href="http://www.kidum-edu.org.il/wp-content/uploads/2016/10/lr-30.jpg" class="portfolio-popup" title="Project Title">
                                <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/10/lr-30.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12 mix apps mockups wordpress" title="Project Title">
                        <div class="item">
                            <a href="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/LR-55r.jpg" class="portfolio-popup">
                                <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/12/LR-55r.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
       
       </div>
     
    </section>
    <!-- Portfolio End -->
    
    
    <!-- About Start -->
    <section id="about" class="about section-space-padding container">
      
          <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>מי אנחנו ?</h2>
                         <div class="divider dark">
						   <i class="icon-emotsmile"></i>
						  </div>
                        <p></p>
                    </div>
                </div>
            </div>
           
            
            <div class="row">
              <div class="col-md-12">
               <div class="about-me-text margin-top-50">
                   האגודה לקידום החינוך היא ארגון חינוכי-חברתי, הפועל מתוך מחויבות למצוינות, להוגנות ולאיכות.

האגודה יוזמת, מפתחת ומפעילה מענים חינוכיים לבני נוער בבתי ספר, בפנימיות, בתכניות ובפרויקטים חינוכיים, במטרה ליצור ולעצב עבורם הזדמנויות למצוינות ולמיצוי ופיתוח הפוטנציאל ההשכלתי והערכי שלהם, כך כשישתלבו במרכז החברה הישראלית.
               </div>
              </div>
               
        <!--<div class="col-md-6">
            <div class="about-me-text pattern-bg margin-top-50 margin-bottom-50">
                <div class="text-center">
                <a class="button button-style button-style-dark button-style-color-2" data-toggle="modal" data-target="#subscribemodal" href="#">Subscribe</a>
                </div>
            </div>

            <div class="about-me-text">
               
            <ul class="social-icon">
                <li><a href="#" target="_blank" class="facebook"><i class="icon-social-facebook"></i></a></li>
                <li><a href="#" target="_blank" class="twitter"><i class="icon-social-twitter"></i></a></li>
                <li><a href="#" target="_blank" class="behance"><i class="icon-social-behance"></i></a></li>
                <li><a href="#" target="_blank" class="dribbble"><i class="icon-social-dribbble"></i></a></li>
            </ul>
               
            </div>
        </div>-->
            </div>
       </section>
       
      <!-- Skills Modal Start -->
      <div class="modal fade padding-top-70" id="skillmodal" role="dialog">
        <div class="modal-dialog">
    
      
      <div class="modal-content pattern-bg">
        <div class="modal-body">
           <div class="row">
                <div class="col-sm-12">
                    <div class="section-title margin-top-30">
                      <button type="button" class="btn pull-right" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        <h2>My Skills.</h2>
                         <div class="divider dark">
						   <i class="icon-energy"></i>
						  </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            
          <div class="row">
           <div class="col-sm-offset-2 col-xs-offset-0 col-md-8 col-sm-8">
          
            <div class="my-skill margin-bottom-50">
                    <strong>Graphic Design</strong>
                       <span class="pull-right">80%</span>
                            <div class="progress">
                                 <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                </div>
                              </div>

                     <strong>Website Design</strong>
                         <span class="pull-right">99%</span>
                             <div class="progress">
                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 99%;">
                                </div>
                              </div>

                      <strong>HTML5/CSS3</strong>
                         <span class="pull-right">85%</span>
                             <div class="progress">
                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                              </div>
                           </div>
                          
                       <strong>Javascript</strong>
                         <span class="pull-right">90%</span>
                             <div class="progress">
                                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                              </div>
                           </div>
                        </div>
          
                   </div>
               </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Skills Modal End -->
      
      
      
      <!-- Subscribe Modal Start -->
      <div class="modal fade subscribe padding-top-120" id="subscribemodal" role="dialog">
        <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-body">
           <div class="row">
                <div class="col-sm-12">
                    <div class="section-title margin-top-30">
                      <button type="button" class="btn pull-right" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        <h2>Subscribe.</h2>
                         <div class="divider dark">
						   <i class="icon-envelope-letter"></i>
						  </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            
          <div class="row">
           <div class="col-sm-offset-2 col-xs-offset-0 col-md-8 col-sm-8">
          
            <div class="margin-bottom-50">
                    <form id="mc-form" method="post" action="http://uipasta.us14.list-manage.com/subscribe/post?u=854825d502cdc101233c08a21&amp;id=86e84d44b7">
								
						  <div class="subscribe-form">
							 <input id="mc-email" type="email" placeholder="Email Address" class="text-input">
							  <button class="submit-btn" type="submit">Submit</button>
								</div>
								<label for="mc-email" class="mc-label"></label>
							  </form>
                           </div>
                        </div>
                     </div>
                 </div>
             </div>
          </div>
       </div>
       <!-- Subscribe Modal End -->
       <!-- About End -->
       <!-- Experience Start -->
    <?php if (!Yii::$app->user->isGuest):?>
    <?php if (Yii::$app->user->identity->userRole != 1):?>
    <section class="section-space-padding">
        <div class="container">
           <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>אנחנו במספרים </h2>
                         <div class="divider dark">
						   <i class="icon-graduation"></i>
						  </div>
                        <p></p>
                    </div>
                </div>
            </div>
            
            <div class="row">
            
            <div class="col-md-6 col-sm-6">
				<div class="experience">
				
				<div class="experience-item">
					<div class="experience-circle">
					   <!--<i class="icon-graduation"></i>-->
                       <p><?=count(Course::find()->where([])->all()) ?></p>
					</div>
					<div class="experience-content experience-color-blue">
						<h4>קורסים</h4>
                        <h6></h6>
						<p></p>
					</div>
				 </div>
				
				<div class="experience-item">
					<div class="experience-circle">
						<!--<i class="icon-trophy"></i> -->
                        <p><?=count(Center::find()->where([])->all()) ?></p>
					</div>
					<div class="experience-content experience-color-blue">
						<h4>מרכזים</h4>
                        <h6></h6>
						<p></p>
					</div>
				 </div>
				
				<div class="experience-item">
					<div class="experience-circle">
						<!--<i class="icon-book-open"></i> -->
                        <p><?=count(Student::find()->where([])->all()) ?></p>
					</div>
					<div class="experience-content experience-color-blue">
						<h4>תלמידים</h4>
                        <h6></h6>
						<p></p>
					</div>
				 </div>
				
			 </div>
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="experience">
				
				<div class="experience-item">
					<div class="experience-circle experience-company pink-color-bg">
					   <!--<i class="icon-energy"></i>-->
                       <p><?=count(Events::find()->where([])->all()) ?></p>
					</div>
					<div class="experience-content">
						<h4>אירועים</h4>
                        <h6></h6>
						<p></p>
					</div>
				 </div>
				
				<div class="experience-item">
					<div class="experience-circle experience-company pink-color-bg">
						<!--<i class="icon-ghost"></i>-->
                        <p><?=count(FundingSource::find()->where([])->all()) ?></p>
					</div>
					<div class="experience-content">
						<h4>מקורות מימון</h4>
                        <h6></h6>
						<p></p>
					</div>
				 </div>
				
				<div class="experience-item">
					<div class="experience-circle experience-company pink-color-bg">
						<!--<i class="icon-compass"></i>-->
                        <p><?=count(Location::find()->where([])->all()) ?></p>
					</div>
					<div class="experience-content">
						<h4>כיתות</h4>
                        <h6></h6>
						<p></p>
					</div>
				 </div>
				
			 </div>
			</div>
            
           </div>
        </div>
    </section>
    <?php endif;?>
     <?php endif;?>
    <!-- Experience End -->

    
   
    
    
      <!-- statistics -->
      <section class="statistics-section section-space-padding bg-cover text-center">
         <div class="">     

            <div class="row">

           <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="statistics bg-color-1">
              <div class="statistics-icon"><i class="icon-mustache"></i>
              </div>
              <div class="statistics-content">
                <h5><span data-count="12000" class="statistics-count">2025</span></h5><span>צעירים שחייהם משתנים בכל יום ויום</span>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="statistics bg-color-6">
              <div class="statistics-icon"><i class="icon-emotsmile"></i>
              </div>
              <div class="statistics-content">
                <h5> <span data-count="6000" class="statistics-count">1200</span></h5><span>תלמידים עולים מקבלים סיוע לימודי ורגשי</span>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="statistics bg-color-4">
              <div class="statistics-icon"><i class="icon-hourglass"></i>
              </div>
              <div class="statistics-content">
                <h5><span data-count="1500" class="statistics-count">8000</span></h5><span>צעירים מתקבלים לאוניברסיטאות ברחבי הארץ על בסיס העדפה מתקנת</span>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="statistics bg-color-5">
              <div class="statistics-icon"><i class="icon-cup"></i>
              </div>
              <div class="statistics-content">
                <h5><span data-count="2500" class="statistics-count">4000</span></h5><span>צעירים מוכשרים נרשמים מידי שנה לבתי הספר ולפנימיות החינוכיות שלנו</span>
              </div>
            </div>
            </div>

         </div>
       </div>
    </section>
    <!-- statistics end -->
    
   
    
    
    
    <!-- Call to Action Start -->
    <section class="call-to-action bg-cover section-space-padding text-center">
       <div class="">
         <div class="row">
           <div class="col-md-8">
             <h2>רוצים לדעת יותר עלינו ?</h2>
             </div>
             
            <div class="col-md-4">
             <div class="text-center">
               <a class="button button-style button-style-color-2 smoth-scroll" href="http://www.kidum-edu.org.il/">לחץ כאן</a>
            </div>
            
            </div>    
          </div>
         </div>
       </section>
       <!-- Call to Action End -->
        
    <!-- Footer Start -->
    <footer class="footer-section">
        <div class="">
            <div class="row">
               
            <div class="col-md-12">
              <ul class="social-icon margin-bottom-30">
                 <li><a href="#" target="_blank" class="facebook"><i class="icon-social-facebook"></i></a></li>
                 <li><a href="#" target="_blank" class="twitter"><i class="icon-social-twitter"></i></a></li>
                 <li><a href="#" target="_blank" class="google-plus"><i class="icon-social-google"></i></a></li>
                 <li><a href="#" target="_blank" class="instagram"><i class="icon-social-instagram"></i></a></li>
                 <li><a href="#" target="_blank" class="dribbble"><i class="icon-social-dribbble"></i></a></li>
               </ul>
          </div>
                
             </div>
        </div>
    </footer>
    <!-- Footer End -->
    
    
    <!-- Back to Top Start -->
    <a href="#" class="scroll-to-top"><i class="icon-arrow-up-circle"></i></a>
    <!-- Back to Top End -->
    
    
    <!-- All Javascript Plugins  -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugin.js"></script>
    
    <!-- Main Javascript File  -->
    <script type="text/javascript" src="js/scripts.js"></script>
  
  
  </body>
  </div>
 </html>