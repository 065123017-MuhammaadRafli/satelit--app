<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; border-bottom: 2px solid #444; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #6777ef; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN ARMADA SATELIT</h2>
        <p>Satelit Monitoring System - Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama Satelit</th>
                <th>Negara</th>
                <th>Orbit</th>
                <th>Ketinggian</th>
                <th>Stasiun Bumi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($satellites as $sat)
            <tr>
                <td>{{ $sat->name }}</td>
                <td>{{ $sat->country }}</td>
                <td>{{ $sat->orbit_type }}</td>
                <td>{{ $sat->altitude }} KM</td>
                <td>{{ $sat->groundStation->name ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
