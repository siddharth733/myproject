import 'bootstrap/dist/css/bootstrap.min.css';
function App() {
  return (
    <div className="App">
    <div class="roll card m-5 bg-transparent border-0">
    <div class="card-body">
      <h1 class="m-5 display-1"><center><b>School Detail For Admission</b></center></h1>
      <h4 class="text-success"><b class="text-dark">School Name :</b> Shayona Vidhyamandir</h4>
      <h4 class="text-success"><b class="text-dark">School Address :</b> Rameshwar Nr Police Station Meghaninagar-380016, Ahmedabad</h4>
      <table class="table table-bordered mt-4 bg-transparent border-dark table-striped table-responsive">
        <thead>
          <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Work</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Siddharth Chauhan</td>
            <td>7896541230</td>
            <td>Principal</td>
            <td>Ahmedabad</td>
          </tr>
          <tr>
          <td>Dhruv Chauhan</td>
          <td>9857898989</td>
          <td>Vice Principal</td>
          <td>Ahmedabad</td>
          </tr>
          <tr>
          <td>Ravi Bavlech</td>
          <td>789654568</td>
          <td>Admission Department</td>
          <td>Mehsana</td>
          </tr>
          <tr>
          <td>Hardik Shakshena</td>
          <td>8787879898</td>
          <td>Fee Department</td>
          <td>Ahmedabad</td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
    </div>
  );
}

export default App;
