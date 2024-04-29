<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,

        // administrator
        'admin' => \App\Http\Middleware\Admin::class,

        // user
        'view_user' =>  \App\Http\Middleware\user\user_view::class,
        'create_user' =>  \App\Http\Middleware\user\user_create::class,
        'edit_user' =>  \App\Http\Middleware\user\user_edit::class,
        'delete_user' =>  \App\Http\Middleware\user\user_delete::class,


        // pdc/document
        'view_document' =>  \App\Http\Middleware\pdc\docments\document_view::class,
        'create_document' =>  \App\Http\Middleware\pdc\docments\document_create::class,
        'edit_document' =>  \App\Http\Middleware\pdc\docments\document_edit::class,
        'delete_document' =>  \App\Http\Middleware\pdc\docments\document_delete::class,

        // pdc/commit
        'view_commita' =>  \App\Http\Middleware\pdc\commite\commite_view::class,
        'create_commita' =>  \App\Http\Middleware\pdc\commite\commite_create::class,
        'edit_commita' =>  \App\Http\Middleware\pdc\commite\commite_edit::class,
        'delete_commita' =>  \App\Http\Middleware\pdc\commite\commite_delete::class,


        // pdc/plan
        'view_plan' =>  \App\Http\Middleware\pdc\plan\plan_view::class,
        'create_plan' =>  \App\Http\Middleware\pdc\plan\plan_create::class,
        'edit_plan' =>  \App\Http\Middleware\pdc\plan\plan_edit::class,
        'delete_plan' =>  \App\Http\Middleware\pdc\plan\plan_delete::class,


        // pdc/scholarship
        'view_scholarship' =>  \App\Http\Middleware\pdc\scholaship\scholarship_view::class,
        'create_scholarship' =>  \App\Http\Middleware\pdc\scholaship\scholarship_create::class,
        'edit_scholarship' =>  \App\Http\Middleware\pdc\scholaship\scholarship_edit::class,
        'delete_scholarship' =>  \App\Http\Middleware\pdc\scholaship\scholarship_delete::class,

        //pdc/workshop
        'view_workshop' =>  \App\Http\Middleware\pdc\workshop\workshop_view::class,
        'create_workshop' =>  \App\Http\Middleware\pdc\workshop\workshop_create::class,
        'edit_workshop' =>  \App\Http\Middleware\pdc\workshop\workshop_edit::class,
        'delete_workshop' =>  \App\Http\Middleware\pdc\workshop\workshop_delete::class,


        // teacher_department/teachers
        'view_teacher' =>  \App\Http\Middleware\teacher_department\techaer\techaer_view::class,
        'create_teacher' =>  \App\Http\Middleware\teacher_department\techaer\techaer_create::class,
        'edit_teacher' =>  \App\Http\Middleware\teacher_department\techaer\techaer_edit::class,
        'delete_teacher' =>  \App\Http\Middleware\teacher_department\techaer\techaer_delete::class,

        //teacher_department/faculty
        'view_faculty' =>  \App\Http\Middleware\teacher_department\faculty\faculty_view::class,
        'create_faculty' =>  \App\Http\Middleware\teacher_department\faculty\faculty_create::class,
        'edit_faculty' =>  \App\Http\Middleware\teacher_department\faculty\faculty_edit::class,
        'delete_faculty' =>  \App\Http\Middleware\teacher_department\faculty\faculty_delete::class,



        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
