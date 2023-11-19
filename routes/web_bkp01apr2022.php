<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(\App::getLocale() == 'ar')
        return redirect()->route('front.ar.home');
    else
        return redirect()->route('front.en.home'); 
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::group(["prefix" => "en","namespace"=>"front", 'as' => 'front.'], function() {
    Route::get('/test-fonts', 'FrontController@fonttest')->name('font-test');
    Route::get('/home', 'FrontController@index')->name('en.home');
    Route::get('/investor-relations', 'InvestorController@index')->name('investor-page');
    Route::any('/investors/contactsave', 'InvestorController@saveInvestorContact')->name('saveInvestorContact');
    Route::get('/join-us', 'JobsController@index');
    Route::get('/join/{job_id}', 'JobsController@jobs')->name('jobApplyForm');
    Route::post('/jobs_apply', 'JobsController@jobs_apply');
    Route::post('/anyone-jobs_apply', 'JobsController@anyoneJobsApply')->name('jobApplyAnyone');
    Route::get('/news-details/{slug}', ['as'=>'news-details', 'uses'=>'NewsController@index']);
    Route::get('/contact-us', 'ContactsController@index'); 
    Route::post('/send_contact', 'ContactsController@submitForm');
    Route::get('/cms/{page}', 'FrontController@pages');
    Route::get('/media-center', 'NewsController@newsListing');
    Route::get('/our-achievements', 'OurAchievementsController@index');

   
});
Route::group(["prefix" => "","namespace"=>"front", 'as' => 'front.'], function() {
    Route::get('/', 'FrontController@index_ar')->name('ar.home');
   Route::get('/investor-relations', 'InvestorController@index_ar')->name('investor-page-ar');
    Route::any('/investors/contactsave', 'InvestorController@saveInvestorContactAr')->name('saveInvestorContactAr');
    Route::get('/join-us', 'JobsController@index_ar');
    Route::get('/join_ar/{job_id}', 'JobsController@jobs_ar')->name('jobApplyFormAr');
    Route::post('/jobs_apply', 'JobsController@jobs_apply_ar');
    Route::post('/anyone-jobs_apply', 'JobsController@anyoneJobsApplyAr')->name('jobApplyAnyoneAr');
    Route::get('/contact-us', 'ContactsController@index_ar'); 
    Route::post('/send_contact', 'ContactsController@submitForm');
    Route::get('/news-details/{slug}', ['as'=>'news-details', 'uses'=>'NewsController@index_ar']);
    Route::get('/cms/{page}', 'FrontController@pages_ar');
    Route::get('/media-center', 'NewsController@newsListingAr');
    Route::get('/our-achievements', 'OurAchievementsController@index_ar');
   
});



/* Start Admin's route */
Route::group(["prefix" => "admin","namespace"=>"admin", 'as' => 'admin.'], function() {
        Route::get('/testing','AuthController@mailTest');
        Route::get('/test', 'AuthController@test');
        Route::get('/', 'AuthController@index');
        Route::get('/login', 'AuthController@index')->name('login');
        Route::post('/authentication','AuthController@verifyCredentials')->name('authentication');
        Route::any('/forgot-password', 'AuthController@forgotPassword')->name('forgot.password');
        Route::any('/reset-password/{encryptCode}','AuthController@resetPassword')->name('reset.password');

        Route::group(['middleware' => 'admin'], function () {
            Route::get('/dashboard', 'DashboardController@dashboardView')->name('dashboard');
            Route::any('/settings', 'DashboardController@settings')->name('settings');
            Route::get('/profile','DashboardController@profile')->name('profile');
            Route::post('/edit-profile','DashboardController@editProfile')->name('editProfile');
            Route::get('/logout', 'AuthController@logout')->name('logout');
            Route::get('/change-password','DashboardController@showChangePasswordForm')->name('changePassword');
            Route::post('/change-password','DashboardController@changePassword')->name('changePassword');


            route::get('roles','RoleController@index')->name('roles')->middleware('check_has_all_permissions:role-list');
            route::get('roles/create','RoleController@create')->name('roles.create');
            route::post('roles/store','RoleController@store')->name('roles.store');
            route::get('roles/{role}/edit','RoleController@edit')->name('roles.edit');
            route::put('roles/{role}/update','RoleController@update')->name('roles.update');
            // route::get('permissions','permissioncontroller@index')->name('permissions');

            Route::group(['prefix' => 'user-management', 'as' => 'user-management.'], function () {
                Route::get('/role-list', 'RoleController@roleList')->name('role-list');
                Route::any('/role-add','RoleController@roleAdd')->name('role-add');
                Route::any('/role-permission/{encryptCode}','RoleController@rolePermission')->name('role.permission');
                Route::get('/edit/{id}', 'RoleController@editRole')->name('edit')->where('id','[0-9]+');
                Route::post('/edit-submit/{id}', 'RoleController@editRole')->name('editSubmit')->where('id','[0-9]+');
                Route::get('/delete/{id}', 'RoleController@roleDelete')->name('delete')->where('id','[0-9]+');
                Route::get('/reset-role-status/{encryptCode}','RoleController@resetRoleStatus')->name('reset-role-status');
                Route::get('/admin-user-list', 'UserController@userList')->name('user.list');
                Route::get('/user-list-table', 'UserController@userListTable')->name('user.list.table');
                Route::get('/site-user-list', 'UserController@SiteuserList')->name('site.user.list');
                Route::get('/site-user-list-table', 'UserController@SiteuserListTable')->name('site.user.list.table');
                Route::any('/user-add','UserController@userAdd')->name('user.add');
                Route::get('/user-edit/{encryptCode}', 'UserController@userEdit')->name('user-edit');
                Route::post('/user-edit-submit/{encryptCode}', 'UserController@userEdit')->name('user-editSubmit');
                Route::any('/user-change-password/{encryptCode}', 'UserController@userChangePassword')->name('user-changepassword');
                Route::get('/user-delete/{encryptCode}','UserController@userDelete')->name('user-delete');
                Route::get('/reset-user-status/{encryptCode}','UserController@resetuserStatus')->name('reset-user-status');
            });




            Route::group(['prefix' => 'cms-management', 'as' => 'cms-management.'], function () {
                Route::get('/cms-list', 'CmsManageController@cmsList')->name('cms.list');
                Route::post('/cms-save','CmsManageController@cmsSave')->name('cms-save');
                Route::any('/add', 'CmsManageController@cmsAdd')->name('cms.add');
                Route::any('/edit/{encryptCode}', 'CmsManageController@cmsEdit')->name('edit');
                // Route::get('/cms-list-table', 'CmsManageController@cmsListTable')->name('list.table');
                // Route::any('/add', 'CmsManageController@cmsAdd')->name('cms.add');
                // Route::any('/edit/{encryptCode}', 'CmsManageController@cmsEdit')->name('edit');
                Route::any('/cms-delete/{encryptCode}', 'CmsManageController@cmsDelete')->name('cms-delete');
                Route::get('/reset-cms-status/{encryptCode}','CmsManageController@resetcmsStatus')->name('reset-cms-status');
                Route::post('/image-delete', 'CmsManageController@ImageDelete')->name('cms-image-delete');
                Route::get('/cms/export','CmsManageController@cmsExport')->name('cms-export');
                // Route::get('/view/{encryptCode}', 'CmsManageController@view')->name('view');
            });

            Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
                Route::get('/list', 'BannerController@bannerList')->name('list');
                Route::get('/add', 'BannerController@bannerAdd')->name('add');
                Route::any('/save', 'BannerController@bannerSave')->name('bannerSave');
                Route::any('/edit/{encryptCode}', 'BannerController@bannerEdit')->name('edit');
                Route::any('/update', 'BannerController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'BannerController@bannerDelete')->name('delete');
                Route::get('/reset-banner-status/{encryptCode}','BannerController@resetBannerStatus')->name('reset-banner-status');
 
            });
            Route::group(['prefix' => 'service-banner', 'as' => 'service-banner.'], function () {
                Route::any('/edit', 'ServiceBannerController@bannerEdit')->name('edit');
                Route::any('/update', 'ServiceBannerController@update')->name('update');
            });
            Route::group(['prefix' => 'jobs-banner', 'as' => 'jobs-banner.'], function () {
                Route::any('/edit', 'JobsBannerController@bannerEdit')->name('edit');
                Route::any('/update', 'JobsBannerController@update')->name('update');
            });

             Route::group(['prefix' => 'news-banner', 'as' => 'news-banner.'], function () {
                Route::any('/edit',    'NewsBannerController@bannerEdit')->name('edit');
                Route::any('/update',  'NewsBannerController@update')->name('update');
            });

            

            Route::group(['prefix' => 'home-page-setting', 'as' => 'home-page-setting.'], function () {
                Route::get('/home-page-list', 'HomePageSettingController@homePageList')->name('homepage.list');
                //Route::any('/edit/{encryptCode}', 'HomePageSettingController@homePageEdit')->name('edit');
                Route::any('/edit', 'HomePageSettingController@homePageEdit')->name('edit');
                Route::any('/update', 'HomePageSettingController@update')->name('update');
                Route::get('/reset-home-status/{encryptCode}','HomePageSettingController@resethomeStatus')->name('reset-home-status');
                Route::post('/image-delete', 'HomePageSettingController@ImageDelete')->name('home-image-delete');
                Route::get('/home/export','HomePageSettingController@homeExport')->name('home-export');

                Route::any('/edithomeheading', 'HomePageSettingController@headingEdit')->name('edithomeheading');
                Route::any('/updateheading', 'HomePageSettingController@updateHeading')->name('updateheading');
 
            });

            Route::group(['prefix' => 'home-page-gallery', 'as' => 'home-page-gallery.'], function () {
                Route::get('/list', 'HomePageGalleryController@HomePageGallery')->name('homepagegallery.list');
                Route::get('/add', 'HomePageGalleryController@serviceAdd')->name('homepagegallery.add');
                Route::any('/save', 'HomePageGalleryController@serviceSave')->name('homepagegallery.serviceSave');
                Route::any('/edit', 'HomePageGalleryController@homeGalleryEdit')->name('edit');
                Route::any('/update', 'HomePageGalleryController@update')->name('update');
                Route::any('/image-delete', 'HomePageGalleryController@ImageDelete')->name('gallery-image-delete');
                Route::get('/reset-home-status/{encryptCode}','HomePageGalleryController@resetGalleryStatus')->name('reset-gallery-status');
                Route::post('/image-delete', 'HomePageGalleryController@ImageDelete')->name('home-image-delete');
                Route::get('/home/export','HomePageGalleryController@homeExport')->name('home-export');


 
            });

            Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
                Route::get('/home-active-service', 'ServiceController@homeActiveService')->name('home.list');

                Route::get('/service-list', 'ServiceController@serviceList')->name('service.list');
                Route::get('/service-add', 'ServiceController@serviceAdd')->name('service.add');
                Route::any('/service-save', 'ServiceController@serviceSave')->name('service.serviceSave');
                Route::any('/edit/{encryptCode}', 'ServiceController@serviceEdit')->name('edit');
                Route::any('/update', 'ServiceController@update')->name('update');
                Route::any('/service/delete/{encryptCode}', 'ServiceController@serviceDelete')->name('service.delete');
                Route::get('/reset-service-status/{encryptCode}','ServiceController@resetServicetatus')->name('reset-service-status');
                Route::post('/image-delete', 'ServiceController@ImageDelete')->name('service-image-delete');
                Route::get('/service/export','ServiceController@homeExport')->name('service-export');
 
            });

            Route::group(['prefix' => 'social', 'as' => 'social.'], function () {
                Route::get('/list', 'SocialController@socialList')->name('social.list');
                Route::get('/add', 'SocialController@serviceAdd')->name('social.add');
                Route::any('/save', 'SocialController@serviceSave')->name('social.serviceSave');
                Route::any('/edit', 'SocialController@socialEdit')->name('edit');
                Route::any('/update', 'SocialController@update')->name('update');
                Route::any('/social/delete/{encryptCode}', 'SocialController@serviceDelete')->name('social.delete');
                Route::get('/reset-social-status/{encryptCode}','SocialController@resetSocialStatus')->name('reset-social-status');
                Route::post('/image-delete', 'SocialController@ImageDelete')->name('social-image-delete');
                Route::get('/social/export','SocialController@homeExport')->name('social-export');

                Route::any('/editpagetilte', 'SocialController@socialPageTitleEdit')->name('editpagetilte');
                Route::any('/updatepagetitle', 'SocialController@pagetitleupdate')->name('updatepagetitle');

                Route::any('/editcontactseo', 'SocialController@contactSeoEdit')->name('editcontactseo');
                Route::any('/updatecontactseo', 'SocialController@contactSeoupdate')->name('updatecontactseo');
                
                Route::any('/editjoinseo', 'SocialController@joinSeoEdit')->name('editjoinseo');
                Route::any('/updatejoinseo', 'SocialController@joinSeoupdate')->name('updatejoinseo');

                Route::any('/editmediacenterseo', 'SocialController@mediacenterSeoEdit')->name('editmediacenterseo');
                Route::any('/updatemediacenterseo', 'SocialController@mediacenterSeoupdate')->name('updatemediacenterseo');

                Route::any('/editserviceseo', 'SocialController@serviceseoSeoEdit')->name('editserviceseo');
                Route::any('/updateserviceseo', 'SocialController@serviceSeoupdate')->name('updateserviceseo');

                Route::any('/editcommunitiesseo', 'SocialController@communitiesSeoEdit')->name('editcommunitiesseo');
                Route::any('/updatecommunitiesseo', 'SocialController@communitiesSeoupdate')->name('updatecommunitiesseo');

                Route::any('/editourachievementsseo', 'SocialController@ourachievementsSeoEdit')->name('editourachievementsseo');
                Route::any('/updateourachievementsseo', 'SocialController@ourachievementsSeoupdate')->name('updateourachievementsseo');

                Route::any('/editsearchseo', 'SocialController@searchSeoEdit')->name('editsearchseo');
                Route::any('/updatesearchseo', 'SocialController@searchSeoupdate')->name('updatesearchseo');
 
            });

            Route::group(['prefix' => 'mediatab', 'as' => 'mediatab.'], function () {
                Route::any('/editmediatab', 'MediatabController@mediaTabEdit')->name('editmediatab');
                Route::any('/updatemediatab', 'MediatabController@mediaTabupdate')->name('updatemediatab');
            });
            
            Route::group(['prefix' => 'jobs', 'as' => 'jobs.'], function () {
                Route::get('/jobs-list', 'JobsController@jobsList')->name('jobs.list');
                Route::get('/jobs-add',  'JobsController@jobsAdd')->name('jobs.add');
                Route::any('/jobs-save', 'JobsController@jobsSave')->name('jobs.jobsSave');
                Route::any('/edit/{encryptCode}', 'JobsController@jobsEdit')->name('edit');
                Route::any('/update', 'JobsController@update')->name('update');
                Route::any('/jobs/delete/{encryptCode}', 'JobsController@jobsDelete')->name('jobs.delete');
                Route::get('/reset-jobs-status/{encryptCode}','JobsController@resetJobsStatus')->name('reset-jobs-status');
 
            });
            Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
                Route::get('/news-list', 'NewsController@newsList')->name('news.list');
                Route::get('/news-add', 'NewsController@newsAdd')->name('news.add');
                Route::any('/news-save', 'NewsController@newsSave')->name('news.newsSave');
                Route::any('/edit/{encryptCode}', 'NewsController@newsEdit')->name('edit');
                Route::any('/update', 'NewsController@update')->name('update');
                Route::any('/news/delete/{encryptCode}', 'NewsController@newsDelete')->name('news.delete');
                Route::get('/reset-news-status/{encryptCode}','NewsController@resetNewsStatus')->name('reset-news-status');
 
            });

            Route::group(['prefix' => 'tv-channels', 'as' => 'tv-channels.'], function () {
                Route::get('/tv-channel-list', 'NewsController@tvChannelList')->name('list');
                Route::get('/tv-channel-add', 'NewsController@tvChannelAdd')->name('add');
                Route::any('/save', 'NewsController@tvChannelSave')->name('tvChannelSave');
                Route::any('/edit/{encryptCode}', 'NewsController@mediaNewsEdit')->name('edit');
                Route::any('/update', 'NewsController@mediaNewsupdate')->name('update');
                Route::any('/media-news/delete/{encryptCode}', 'NewsController@mediaNewsDelete')->name('media.news.delete');
                Route::get('/reset-media-news-status/{encryptCode}','NewsController@resetMediaNewsStatus')->name('reset-media-news-status');
 
            });

            Route::group(['prefix' => 'press-kits', 'as' => 'press-kits.'], function () {
                Route::get('/list', 'NewsController@pressKitList')->name('list');
                Route::get('/add', 'NewsController@pressKitAdd')->name('add');
                Route::any('/save', 'NewsController@pressKitSave')->name('pressKitSave');
                Route::any('/edit/{encryptCode}','NewsController@pressKitEdit')->name('edit');
                Route::any('/update', 'NewsController@pressKitupdate')->name('update');
                Route::any('/press-kit/delete/{encryptCode}', 'NewsController@pressKitDelete')->name('press.kit.delete');
                Route::get('/reset-press-kit-status/{encryptCode}','NewsController@pressKitStatus')->name('reset-press-kit-status');
 
            });

            Route::group(['prefix' => 'brand-guideline', 'as' => 'brand-guideline.'], function () {
                Route::get('/list', 'NewsController@brandGuidelineList')->name('list');
                Route::get('/add', 'NewsController@brandGuidelineAdd')->name('add');
                Route::any('/save', 'NewsController@brandGuidelineSave')->name('brandGuideSave');
                Route::any('/edit/{encryptCode}','NewsController@brandGuidelineEdit')->name('edit');
                Route::any('/update', 'NewsController@brandGuidelineupdate')->name('update');
                Route::any('/brand-guidelines/delete/{encryptCode}', 'NewsController@brandGuidelineDelete')->name('brand.guidelines.delete');
                Route::get('/reset-brand-guidelines-status/{encryptCode}','NewsController@brandGuidelineStatus')->name('reset-brand-guidelines-status');
 
            });

            Route::group(['prefix' => 'country', 'as' => 'country.'], function () {
                Route::get('/list', 'CountryController@countryList')->name('country.list');
                Route::get('/add', 'CountryController@countryAdd')->name('country.add');
                Route::any('/save', 'CountryController@countrySave')->name('country.countrySave');
                Route::any('/edit/{encryptCode}', 'CountryController@countryEdit')->name('edit');
                Route::any('/update', 'CountryController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'CountryController@countryDelete')->name('country.delete');
                Route::get('/reset-country-status/{encryptCode}','CountryController@resetCountryStatus')->name('reset-country-status');
 
            });

            Route::group(['prefix' => 'state', 'as' => 'state.'], function () {
                Route::get('/list', 'StateController@stateList')->name('state.list');
                Route::get('/add', 'StateController@stateAdd')->name('state.add');
                Route::any('/save', 'StateController@stateSave')->name('state.stateSave');
                Route::any('/edit/{encryptCode}', 'StateController@stateEdit')->name('edit');
                Route::any('/update', 'StateController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'StateController@stateDelete')->name('state.delete');
                Route::get('/reset-state-status/{encryptCode}','StateController@resetStateStatus')->name('reset-state-status');
 
            });

            Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
                Route::get('/list', 'CityController@cityList')->name('city.list');
                Route::get('/add', 'CityController@cityAdd')->name('city.add');
                Route::any('/save', 'CityController@citySave')->name('city.citySave');
                Route::any('/edit/{encryptCode}', 'CityController@cityEdit')->name('edit');
                Route::any('/update', 'CityController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'CityController@cityDelete')->name('city.delete');
                Route::get('/reset-city-status/{encryptCode}','CityController@resetCityStatus')->name('reset-city-status');
 
            });

            Route::group(['prefix' => 'investor-relations', 'as' => 'investor-relations.'], function () {
 		Route::get('/admincmschng', 'InvestorController@admincmschng')->name('admincmschng');
                Route::any('/buttonedit', 'InvestorController@buttonedit')->name('buttonedit');
		Route::any('/buttoneditupdate', 'InvestorController@buttoneditupdate')->name('buttoneditupdate');


		Route::any('/button', 'InvestorController@buttontextchange')->name('button');
		 Route::any('/buttonupdate', 'InvestorController@buttonupdate')->name('buttonupdate');
		//Route::any('/buttonedit', 'InvestorController@buttonedit')->name('buttonedit');
		//Route::any('/buttoneditupdate', 'InvestorController@buttoneditupdate')->name('buttoneditupdate');

                Route::get('/investor-achievement-list', 'InvestorController@investorAchievementList')->name('list');
                Route::get('/investor-achievement-add', 'InvestorController@investorAchievementAdd')->name('add');
                Route::any('/investor-achievement-save', 'InvestorController@investorAchievementSave')->name('Save');
                Route::any('/investor-achievement-edit/{encryptCode}', 'InvestorController@investorAchievementEdit')->name('investor-achievement-edit');
                Route::any('/save', 'InvestorController@investorSave')->name('investorSave');
                Route::any('/edit', 'InvestorController@investorEdit')->name('edit');
                Route::any('/update', 'InvestorController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'InvestorController@investorAchievementDelete')->name('delete');
                Route::get('/reset-investor-status/{encryptCode}','InvestorController@resetInvestorAchievementStatus')->name('reset-investor-status');
                Route::post('/pdf-delete', 'InvestorController@PdfDelete')->name('investor-pdf-delete');
                    
            });

            Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
                Route::get('/list', 'ContactController@contactList')->name('contacts.list');
                Route::get('/reset-contact-status/{encryptCode}','ContactController@resetContactStatus')->name('reset-contact-status');
                Route::get('/delete/{encryptCode}','ContactController@delete')->name('delete');
                Route::any('/contacts-settings', 'ContactController@contactUsSetting')->name('contact-settings');
                Route::any('/save-contact-us-settings', 'ContactController@contactUsSave')->name('save-contact-settings');

            });

            Route::group(['prefix' => 'our-achievements', 'as' => 'our-achievements.'], function () {
                Route::get('/list', 'OurAchievementController@ourAchievementList')->name('list');
                Route::get('/add', 'OurAchievementController@ourAchievementAdd')->name('add');
                Route::any('/save', 'OurAchievementController@ourAchievementSave')->name('ourAchievement.Save');
                Route::any('/edit/{encryptCode}', 'OurAchievementController@ourAchievementEdit')->name('edit');
                Route::any('/update', 'OurAchievementController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'OurAchievementController@ourAchievementDelete')->name('delete');
                Route::get('/reset-ourAchievement-status/{encryptCode}','OurAchievementController@resetourAchievementStatus')->name('reset-status');
 
            });

            Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
                Route::get('/list', 'CategoryController@categoryList')->name('list');
                Route::get('/add', 'CategoryController@categoryAdd')->name('add');
                Route::any('/save', 'CategoryController@categorySave')->name('category.Save');
                Route::any('/edit/{encryptCode}', 'CategoryController@categoryEdit')->name('edit');
                Route::any('/update', 'CategoryController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'CategoryController@categoryDelete')->name('delete');
                Route::get('/reset-category-status/{encryptCode}','CategoryController@resetcategoryStatus')->name('reset-status');
 
            });

            Route::group(['prefix' => 'subcategory', 'as' => 'subcategory.'], function () {
                Route::get('/list', 'SubCategoryController@subcategoryList')->name('list');
                Route::get('/add', 'SubCategoryController@subcategoryAdd')->name('add');
                Route::any('/save', 'SubCategoryController@subcategorySave')->name('subcategory.Save');
                Route::any('/edit/{encryptCode}', 'SubCategoryController@subcategoryEdit')->name('edit');
                Route::any('/update', 'SubCategoryController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'SubCategoryController@subcategoryDelete')->name('delete');
                Route::get('/reset-subcategory-status/{encryptCode}','SubCategoryController@resetsubcategoryStatus')->name('reset-status');
 
            });

            Route::group(['prefix' => 'ourbrand', 'as' => 'ourbrand.'], function () {
                Route::get('/list', 'OurbrandController@ourbrandList')->name('list');
                Route::get('/add', 'OurbrandController@ourbrandAdd')->name('add');
                Route::any('/save', 'OurbrandController@ourbrandSave')->name('ourbrand.Save');
                Route::any('/edit/{encryptCode}', 'OurbrandController@ourbrandEdit')->name('edit');
                Route::any('/update', 'OurbrandController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'OurbrandController@ourbrandDelete')->name('delete');
                Route::get('/reset-ourbrand-status/{encryptCode}','OurbrandController@resetourbrandStatus')->name('reset-status');
                Route::get('/ourbrandsettings', 'OurbrandController@ourbrandSettings')->name('ourbrandsettings');
                Route::any('/updateourbrandsettings', 'OurbrandController@ourbrandSettingsUpdate')->name('updateourbrandsettings');
 
            });

            Route::group(['prefix' => 'position', 'as' => 'position.'], function () {
                Route::get('/list', 'PositionController@positionList')->name('list');
                Route::get('/add', 'PositionController@positionAdd')->name('add');
                Route::any('/save', 'PositionController@positionSave')->name('position.Save');
                Route::any('/edit/{encryptCode}', 'PositionController@positionEdit')->name('edit');
                Route::any('/update', 'PositionController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'PositionController@positionDelete')->name('delete');
                Route::get('/reset-position-status/{encryptCode}','PositionController@resetpositionStatus')->name('reset-status');
                
                Route::any('/editceopdf', 'PositionController@ceoPdfEdit')->name('editceopdf');
                Route::any('/updateceopdf', 'PositionController@ceoPdfupdate')->name('updateceopdf');

                Route::post('/getsubcategory', 'PositionController@getSubCategory')->name('getsubcategory');
            });

            /*dropdown*/
            Route::any('/fetch-states', 'CityController@fetchState')->name('fetch-states');



            Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
                Route::get('/index', 'ProjectController@index')->name('index');
                Route::post('/save','ProjectController@save')->name('save');
                Route::any('/add', 'ProjectController@add')->name('add');
                Route::any('/edit/{encryptCode}', 'ProjectController@edit')->name('edit');
// pdf delete
                Route::any('/PdfprojectDelete', 'ProjectController@PdfprojectDelete')->name('project-pdf-delete');

                Route::get('/get-project-featured-status/{project_id}', 'ProjectController@getProjectFeaturedStatus')->name('get.project.featured.status');
                Route::post('/upload-featutred-image', 'ProjectController@uploadFeatutredImage')->name('upload.featured.image');
                Route::post('/update','ProjectController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'ProjectController@projectDelete')->name('delete');
                Route::get('/reset-project-status/{encryptCode}','ProjectController@set_status')->name('reset-project-status');
                Route::get('/reset-project-feature/{encryptCode}','ProjectController@set_feature')->name('reset-project-feature');

                Route::get('/faq/index', 'FaqController@faqIndex')->name('faq.index');
                Route::post('/faq/save','FaqController@faqSave')->name('faq.save');
                Route::any('/faq/add', 'FaqController@faqAdd')->name('faq.add');
                Route::any('/faq/edit/{encryptCode}', 'FaqController@faqEdit')->name('faq.edit');
                Route::post('/faq/update','FaqController@faqUpdate')->name('faq.update');
                Route::any('/faq/delete/{encryptCode}', 'FaqController@faqDelete')->name('faq.delete');
                Route::get('/reset-faq-status/{encryptCode}','FaqController@set_status')->name('reset-faq-status');
                Route::any('/faq/support-chat-admin', 'FaqController@chatAdmin')->name('faq.chat.admin');
            });

            Route::group(['prefix' => 'unit', 'as' => 'unit.'], function () {

                Route::get('/index/{encryptProjectCode}', 'ProjectController@unitIndex')->name('index');
                Route::post('/save','ProjectController@unitSave')->name('save');
                Route::any('/add/{encryptProjectCode}', 'ProjectController@unitAdd')->name('add');
                Route::any('/edit/{encryptProjectCode}', 'ProjectController@unitEdit')->name('edit');
                Route::post('/update','ProjectController@unitUpdate')->name('update');
                Route::any('/delete/{encryptProjectCode}', 'ProjectController@unitDelete')->name('delete');
            });

            Route::group(['prefix' => 'projectservices', 'as' => 'projectservices.'], function () {
                Route::get('/index', 'ProjectServiceController@index')->name('index');
                Route::post('/save','ProjectServiceController@save')->name('save');
                Route::any('/add', 'ProjectServiceController@add')->name('add');
                Route::any('/edit/{encryptCode}', 'ProjectServiceController@edit')->name('edit');
                Route::post('/update','ProjectServiceController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'ProjectServiceController@delete')->name('delete');
                Route::get('/reset-project-service-status/{encryptCode}','ProjectServiceController@set_status')->name('reset-project-service-status');
                // Route::get('/cms/export','CmsManageController@cmsExport')->name('cms-export');
                // Route::get('/view/{encryptCode}', 'CmsManageController@view')->name('view');
            });


            Route::group(['prefix' => 'projectnear', 'as' => 'projectnear.'], function () {
                Route::get('/index', 'ProjectNearController@index')->name('index');
                Route::post('/save','ProjectNearController@save')->name('save');
                Route::any('/add', 'ProjectNearController@add')->name('add');
                Route::any('/edit/{encryptCode}', 'ProjectNearController@edit')->name('edit');
                Route::post('/update','ProjectNearController@update')->name('update');
                Route::any('/delete/{encryptCode}', 'ProjectNearController@delete')->name('delete');
                Route::get('/reset-project-near-status/{encryptCode}','ProjectNearController@set_status')->name('reset-project-near-status');
                // Route::get('/cms/export','CmsManageController@cmsExport')->name('cms-export');
                // Route::get('/view/{encryptCode}', 'CmsManageController@view')->name('view');
            });

            Route::group(['prefix' => 'status', 'as' => 'status.'], function () {
                Route::get('/index', 'ProjectStatusController@index')->name('index');
                Route::post('/save','ProjectStatusController@save')->name('save');
                Route::any('/add', 'ProjectStatusController@add')->name('add');
                Route::any('/edit/{encryptCode}', 'ProjectStatusController@edit')->name('edit');
                Route::post('/update','ProjectStatusController@update')->name('update');
                Route::any('/status-delete/{encryptCode}', 'ProjectStatusController@delete')->name('status-delete');
                Route::get('/reset-status/{encryptCode}','ProjectStatusController@set_status')->name('reset-status');
                // Route::get('/cms/export','CmsManageController@cmsExport')->name('cms-export');
                // Route::get('/view/{encryptCode}', 'CmsManageController@view')->name('view');
            });

            Route::group(['prefix' => 'type', 'as' => 'type.'], function () {
                Route::get('/index', 'ProjectTypeController@index')->name('index');
                Route::post('/save','ProjectTypeController@save')->name('save');
                Route::any('/add', 'ProjectTypeController@add')->name('add');
                Route::any('/edit/{encryptCode}', 'ProjectTypeController@edit')->name('edit');
                Route::post('/update','ProjectTypeController@update')->name('update');
                Route::any('/status-delete/{encryptCode}', 'ProjectTypeController@delete')->name('status-delete');
                Route::get('/reset-status/{encryptCode}','ProjectTypeController@set_status')->name('reset-status');
                // Route::get('/cms/export','CmsManageController@cmsExport')->name('cms-export');
                // Route::get('/view/{encryptCode}', 'CmsManageController@view')->name('view');
            });
  
        });

       
});


//Route::get('/{any}', 'Controller@callFrontendRoute')->where('any', '.*');
/* English Site */

Route::group(['prefix' => 'en', 'as' => 'en.'], function () {
    Route::any('/communities',  ['as'=>'projectlist.index', 'uses'=>'front\ProjectController@index']);
    Route::any('/project-detail/{slug}',  ['as'=>'projectdetail.detail', 'uses'=>'front\ProjectController@each']);
    Route::any('/project/contactsave',  ['as'=>'projectcontact.savecontact', 'uses'=>'front\ProjectController@saveContact']);

    Route::any('/service',  ['as'=>'servicelist.index', 'uses'=>'front\ServiceController@index']);
    Route::any('/service-detail/{slug}',  ['as'=>'servicedetail.detail', 'uses'=>'front\ServiceController@each']);

    Route::any('/search',  ['as'=>'search.index', 'uses'=>'front\SearchController@index']);
});    

/* Arabic Site */
Route::group(['prefix' => '', 'as' => ''], function () {
    Route::any('/communities',  ['as'=>'projectlist.index', 'uses'=>'front\ProjectController@indexAr']);
    Route::any('/project-detail/{slug}',  ['as'=>'projectdetail.detail', 'uses'=>'front\ProjectController@eachAr']);
    Route::any('/project/contactsave',  ['as'=>'projectcontact.savecontact', 'uses'=>'front\ProjectController@saveContactAr']);

    Route::any('/service',  ['as'=>'servicelist.index', 'uses'=>'front\ServiceController@indexAr']);
    Route::any('/service-detail/{slug}',  ['as'=>'servicedetail.detail', 'uses'=>'front\ServiceController@eachAr']);

    Route::any('/search',  ['as'=>'search.index', 'uses'=>'front\SearchController@indexAr']);
});

