<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <label for="province">Provinsi:</label>
  <select id="province" onchange="populateCities()">
    <option value="">Pilih Provinsi</option>
  </select>

  <label for="city">Kota:</label>
  <select id="city" onchange="populateDistricts()">
    <option value="">Pilih Kota</option>
  </select>

  <label for="district">Kecamatan:</label>
  <select id="district">
    <option value="">Pilih Kecamatan</option>
  </select>

  <script>
    const provinces = [{
        id: 1,
        name: 'Aceh'
      },
      {
        id: 2,
        name: 'Bali'
      }
    ];

    const cities = {
      1: [{
          id: 101,
          name: 'Aceh Barat'
        },
        {
          id: 102,
          name: 'Aceh Barat Daya'
        },
        {
          id: 103,
          name: 'Aceh Besar'
        }
      ],
      2: [{
          id: 201,
          name: 'Badung'
        },
        {
          id: 202,
          name: 'Bangli'
        },
        {
          id: 203,
          name: 'Buleleng'
        }
      ]
    };

    const districts = {
      101: [{
          id: 1001,
          name: 'Arongan Lambalek'
        },
        {
          id: 1002,
          name: 'Johan Pahlawan'
        },
        {
          id: 1003,
          name: 'Woyla'
        }
      ],
      102: [{
          id: 1004,
          name: 'Baktiya'
        },
        {
          id: 1005,
          name: 'Kaway XVI'
        },
        {
          id: 1006,
          name: 'Meureubo'
        }
      ],
      103: [{
          id: 1007,
          name: 'Baitussalam'
        },
        {
          id: 1008,
          name: 'Darul Imarah'
        },
        {
          id: 1009,
          name: 'Darussalam'
        }
      ],
      201: [{
          id: 2001,
          name: 'Abiansemal'
        },
        {
          id: 2002,
          name: 'Kuta'
        },
        {
          id: 2003,
          name: 'Mengwi'
        }
      ],
      202: [{
          id: 2004,
          name: 'Bangli'
        },
        {
          id: 2005,
          name: 'Kintamani'
        },
        {
          id: 2006,
          name: 'Susut'
        }
      ],
      203: [{
          id: 2007,
          name: 'Busungbiu'
        },
        {
          id: 2008,
          name: 'Sawan'
        },
        {
          id: 2009,
          name: 'Seririt'
        }
      ]
    };

    // inisiate
    populateProvince();
    // console.log();


    function populateProvince() {
      const provinceDropdown = document.getElementById('province');
      for (let i = 0; i < provinces.length; i++) {
        const option = document.createElement('option');
        option.text = provinces[i]['name'];
        option.value = provinces[i]['id'];
        provinceDropdown.add(option);
      }
    }

    function populateCities() {
      const province = document.getElementById('province').value;
      const cityDropdown = document.getElementById('city');
      cityDropdown.innerHTML = '<option value="">Pilih Kota</option>';

      if (province) {
        for (let i = 0; i < cities[province].length; i++) {
          const option = document.createElement('option');
          option.text = cities[province][i]['name'];
          option.value = cities[province][i]['id'];
          cityDropdown.add(option);
        }
      }
    }

    function populateDistricts() {
      const city = document.getElementById('city').value;
      const districtDropdown = document.getElementById('district');
      districtDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';

      if (city) {
        for (let i = 0; i < districts[city].length; i++) {
          const option = document.createElement('option');
          option.text = districts[city][i]['name'];
          option.value = districts[city][i]['id'];
          districtDropdown.add(option);
        }
      }
    }
  </script>
</body>

</html>