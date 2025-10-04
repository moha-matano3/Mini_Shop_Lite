<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9fafb; padding: 20px;">

  <div style="max-width: 600px; margin: auto; background: white; padding: 25px; border-radius: 8px;">
    <h2 style="color: #16a34a;">✅ Thank you for your purchase, {{ $order->user->name ?? 'Customer' }}!</h2>

    <p>Your order has been placed successfully.</p>

    <h3 style="margin-top: 20px;">Order Details:</h3>
    <p><strong>Order Number:</strong> #{{ $order->id }}</p>
    <p><strong>Total Amount:</strong> KES {{ number_format($order->total) }}</p>

    <table width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin-top: 10px;">
      <thead style="background: #f3f4f6;">
        <tr>
          <th align="left">Product</th>
          <th align="center">Qty</th>
          <th align="right">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($order->items as $item)
        <tr>
          <td>{{ $item->product->name }}</td>
          <td align="center">{{ $item->quantity }}</td>
          <td align="right">KES {{ number_format($item->line_total) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <p style="margin-top: 20px;">We'll notify you once your order is ready for delivery or pickup.</p>

    <p style="margin-top: 30px; color: gray;">&copy; {{ date('Y') }} MiniShopLite. All rights reserved.</p>
  </div>

</body>
</html>