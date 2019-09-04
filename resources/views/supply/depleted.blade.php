<!DOCTYPE html>
<html>

<head>
    <style>
    table {
        border-collapse: collapse;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 15px;
        background-color: #e8f9ff;
        color: #000;
    }

    th {
        text-align: left;
    }

    thead {
        th {
            background-color: #e0f7ff;
        }
    }

    tbody {
        tr {
            &:hover {
                background-color: rgba(255, 255, 255, 0.3);
            }
        }

        td {
            position: relative;

            &:hover {
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: -9999px;
                    bottom: -9999px;
                    background-color: rgba(255, 255, 255, 0.2);
                    z-index: -1;
                }
            }
        }
    }

    </style>
</head>

<body>
    @php
    $query = $data;
    @endphp
<h1> Breads </h1>    
<table>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Category</th>
        </tr>
        @foreach ($query as $data)
        @if($data['category']['title'] == 'Bread' || $data['category']['title'] == 'Cake')
        <tr>
            <td>{{$data['description']}}</td>
            <td>{{$data['quantity']}}</td>
            <td>{{$data['category']['title']}}</td>
        </tr>
        @endif
        @endforeach
    </table>
    <h1> Other Items </h1>
    <table>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Category</th>
        </tr>
        @foreach ($query as $data)
        @if($data['category']['title'] != "Bread" && $data['category']['title'] != 'Cake')
        <tr>
            <td>{{$data['description']}}</td>
            <td>{{$data['quantity']}}</td>
            <td>{{$data['category']['title']}}</td>
        </tr>
        @endif
        @endforeach
    </table>
</body>

</html>
