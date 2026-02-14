<div style="font-family: sans-serif; color: #334155; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px;">
    <h2 style="color: #4f46e5;">Hi {{ $itRequest->full_name }},</h2>
    <p>The status of your IT request <strong>"{{ $itRequest->title }}"</strong> has been updated to:</p>

    <div style="display: inline-block; padding: 10px 20px; background-color: #f1f5f9; border-radius: 50px; font-weight: bold; color: #1e293b; text-transform: uppercase; margin: 10px 0;">
        {{ str_replace('-', ' ', $itRequest->status) }}
    </div>

    <p>Our team is working to ensure your issue is handled efficiently. You don't need to take any action at this time.</p>

    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">
    <p style="font-size: 12px; color: #94a3b8;">This is an automated message from the IT Support Portal.</p>
</div>
