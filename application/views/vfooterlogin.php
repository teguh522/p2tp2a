  <script src="<?php echo base_url() ?>assets/vendor/bundles/libscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/vendorscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/mainscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/c3.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/dropify/js/dropify.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/forms/dropify.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/datatablescripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/tables/jquery-datatable.js"></script>
  <!-- include summernote css/js -->
  <link href="<?php echo base_url() ?>assets/vendor/summernote/dist/summernote.css" rel="stylesheet">
  <script src="<?php echo base_url() ?>assets/vendor/summernote/dist/summernote.js"></script>

  <script src="<?php echo base_url() ?>assets/vendor/sweetalert2.min.js"></script>

  <link href="<?php echo base_url() ?>assets/vendor/select2.min.css" rel="stylesheet" />
  <script src="<?php echo base_url() ?>assets/vendor/select2.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script>
      const mymap = L.map('mapCirebon').setView([-6.728492389750036, 108.52666033181482], 11);
      const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
      const titleURL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}';
      const tiles = L.tileLayer(titleURL, {
          foo: 'bar',
          attribution
      });
      tiles.addTo(mymap);
      const api_url = "<?= base_url('admin/get_kecamatan') ?>";

      async function getdatamap() {
          const response = await fetch(api_url);
          const data = await response.json();
          data.kecamatan.map((val) => {
              L.marker([val.latitude, val.longitude], {
                  title: val.nama_kecamatan
              }).addTo(mymap).bindPopup(`Total kasus ${val.totalpengaduan}`)
          })
      }
      getdatamap()

      async function getdatachartkec() {
          const response = await fetch(api_url);
          const data = await response.json();
          let kategori = []
          let datachart = ['data1']

          data.kecamatan.map(item => {
              kategori.push(item.nama_kecamatan)
              datachart.push(item.totalpengaduan)
          })
          var chart = c3.generate({
              bindto: '#chart-bar2', // id of chart wrapper
              data: {
                  columns: [
                      // each columns data
                      datachart,
                  ],
                  types: {
                      data1: 'area-spline',
                  }, // default type of chart
                  colors: {
                      'data1': '#9400D3', // blue            
                  },
                  names: {
                      // name of each serie
                      'data1': "Kasus",
                  }
              },
              axis: {
                  x: {
                      type: 'category',
                      // name of each category
                      categories: kategori
                  },
              },
              legend: {
                  show: true, //hide legend
              },
              padding: {
                  bottom: 20,
                  top: 0
              },
          });


      }
      getdatachartkec()
  </script>
  <script>
      $(function() {
          let searchParams = new URLSearchParams(window.location.search);

          if (searchParams.has('func')) {
              $('#form-hidden').show();
          } else {
              $('#form-hidden').hide();
          }
          $('#basic-form').parsley();
          $('#btntambah').on('click', function(e) {
              e.preventDefault();
              $('#form-hidden').show('slow');
          });
          $('#summernote').summernote({
              //   toolbar: [
              //       ['style', ['bold', 'italic', 'underline', 'clear']],
              //       ['font', ['strikethrough', 'superscript', 'subscript']],
              //       ['fontsize', ['fontsize']],
              //       ['color', ['color']],
              //       ['para', ['ul', 'ol', 'paragraph']],
              //       ['height', ['height']],
              //   ],
              //   placeholder: 'Kualifikasi Loker',
              tabsize: 2,
              height: 230
          });
          const url = "<?= base_url('admin/get_jumlahkasus') ?>";
          async function getdataperkasus() {
              const response = await fetch(url);
              const data = await response.json();
              let kategori = []
              let datachart = ['data1']
              data.kasus.map(item => {
                  kategori.push(item.nama_kasus)
                  datachart.push(item.totalkasus)
              })
              var chart = c3.generate({
                  bindto: '#chart-bar', // id of chart wrapper
                  data: {
                      columns: [
                          // each columns data
                          datachart,
                      ],
                      types: {
                          data1: 'area-spline',
                      }, // default type of chart
                      colors: {
                          'data1': '#007FFF', // blue            
                      },
                      names: {
                          // name of each serie
                          'data1': "Kasus",
                      }
                  },
                  axis: {
                      x: {
                          type: 'category',
                          // name of each category
                          categories: kategori
                      },
                  },
                  legend: {
                      show: true, //hide legend
                  },
                  padding: {
                      bottom: 20,
                      top: 0
                  },
              });


          }
          getdataperkasus()

      })
  </script>
  </body>

  </html>