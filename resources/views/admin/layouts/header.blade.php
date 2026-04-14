<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,  initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <title>Admin Motor</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />

    <style>
          /* Custom scrollbar for activity list */
    .activity-list::-webkit-scrollbar {
        width: 4px;
    }
    
    .activity-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .activity-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .activity-list::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .transition {
        transition: all 0.2s ease;
    }
    
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .activity-list {
            max-height: 400px;
        }
    }
    </style>
</head>
