<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>easepick</title>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
  </head>
  <body>
    <input id="datepicker"/>
    <script>
      function displayLaunchDates() {
        // Query the database for launch dates and their associated SKUs
        const url = '../base/action/action_query_data_json.php';
        const query = `SELECT launch_date, SUM(sku) FROM all_in_one_project.add_new_job WHERE status NOT IN ('approved', 'cancel') AND status NOT LIKE '%cancel%' AND config_type = 'task' GROUP BY launch_date ORDER BY launch_date ASC`;

        fetch(`${url}?query=${encodeURIComponent(query)}`)
          .then(response => response.json())
          .then(data => {
            // Extract the launch dates and SKUs from the query result
            const launchDates = data.map(row => row.launch_date);
            const skuCounts = data.map(row => row['SUM(sku)']);
            const skuData = {};
            for (let i = 0; i < launchDates.length; i++) {
              skuData[launchDates[i]] = skuCounts[i];
            }

            // Use the easepick library to display the launch dates and SKUs in a calendar
            const picker = new easepick.create({
              element: document.getElementById('datepicker'),
              css: [
                'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
                'https://easepick.com/css/demo_prices.css',
              ],
              setup(picker) {
                // Add SKU count to day element
                picker.on('view', (evt) => {
                  const { view, date, target } = evt.detail;
                  const d = date ? date.format('YYYY-MM-DD') : null;

                  if (view === 'CalendarDay' && skuData[d]) {
                    const span = target.querySelector('.day-price') || document.createElement('span');
                    span.className = 'day-price';
                    span.innerHTML = `${skuData[d]} SKU`;
                    target.append(span);
                  }
                });
              }
            });
          })
          .catch(error => console.error(error));
      }

      displayLaunchDates();
    </script>
  </body>
</html>
