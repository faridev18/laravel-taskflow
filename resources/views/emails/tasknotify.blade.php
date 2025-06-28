<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation à un tache</title>
    <style type="text/css">
        /* Base styles */
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        
        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Card */
        .email-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        
        /* Header */
        .email-header {
            background-color: #4f46e5;
            padding: 24px;
            text-align: center;
        }
        
        .email-header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        /* Content */
        .email-content {
            padding: 32px;
        }
        
        .welcome-text {
            font-size: 18px;
            margin-bottom: 24px;
            color: #111827;
        }
        
        .details-box {
            background-color: #f9fafb;
            border-left: 4px solid #4f46e5;
            padding: 16px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
        }
        
        .detail-item {
            margin-bottom: 8px;
            display: flex;
        }
        
        .detail-label {
            font-weight: 600;
            color: #4b5563;
            min-width: 80px;
        }
        
        /* Button */
        .action-button {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            margin: 24px 0;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .action-button:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
        
        /* Footer */
        .email-footer {
            text-align: center;
            padding-top: 24px;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
            margin-top: 24px;
        }
        
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-content {
                padding: 24px;
            }
            
            .email-header h1 {
                font-size: 20px;
            }
            
            .welcome-text {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-card">
            <!-- Header -->
            <div class="email-header">
                <h1>Nouvelle tache</h1>
            </div>
            
            <!-- Content -->
            <div class="email-content">
                <p class="welcome-text">Bonjour <strong>{{ $user->name }}</strong>,</p>
                
                <p>Vous avez été mentionné sur une tache .</p>
                <p>Elle est intitulé : <strong>{{$task->title}}</strong> .</p>
              
                
                <p>Cliquez sur le bouton ci-dessous pour accéder au workspace :</p>
                
                <div style="text-align: center;">
                    <a href="{{ url('/my-workspace') }}" class="action-button">
                        Accéder au workspace
                    </a>
                </div>
                
                <p>Si le bouton ne fonctionne pas, copiez-collez ce lien dans votre navigateur :</p>
                <p style="word-break: break-all; color: #4f46e5; font-size: 14px;">{{ url('/my-workspace') }}</p>
            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                <p>© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
                <p>Cet email vous a été envoyé automatiquement, merci de ne pas y répondre.</p>
            </div>
        </div>
    </div>
</body>
</html>