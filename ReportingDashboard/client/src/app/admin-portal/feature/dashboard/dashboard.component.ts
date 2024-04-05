import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
})
export class DashboardComponent implements OnInit {
  constructor() {}

  revenue12Month = [
    {
      name: 'Revenue',
      series: [
        { name: 'January', value: 235466 },
        { name: 'February', value: 350679 },
        { name: 'March', value: 540900 },
        { name: 'April', value: 600002 },
        { name: 'May', value: 450750 },
        { name: 'June', value: 124300 },
        { name: 'July', value: 120500 },
        { name: 'August', value: 340600 },
        { name: 'September', value: 500000 },
        { name: 'October', value: 765000 },
        { name: 'November', value: 900000 },
        { name: 'December', value: 345800 },
      ],
    },
  ];
  diamondSales12Month = [
    {
      name: 'Diamond Sales',
      series: [
        { name: 'January', value: 3502 },
        { name: 'February', value: 4531 },
        { name: 'March', value: 2506 },
        { name: 'April', value: 4359 },
        { name: 'May', value: 9890 },
        { name: 'June', value: 10000 },
        { name: 'July', value: 7543 },
        { name: 'August', value: 6789 },
        { name: 'September', value: 7524 },
        { name: 'October', value: 9000 },
        { name: 'November', value: 12545 },
        { name: 'December', value: 13265 },
      ],
    },
  ];
  applications = [
    { name: 'Permits', value: 105000 },
    { name: 'Licenses', value: 55000 },
    { name: 'Certificates', value: 15000 },
  ];

  employment = [
    { name: 'Cutters', value: 252 },
    { name: 'Other', value: 48 },
    { name: 'Polishers', value: 525 },
  ];

  ngOnInit(): void {}
}
