import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../data-access/report.service';
import { ToastrService } from 'ngx-toastr';
@Component({
  selector: 'app-profiling',
  templateUrl: './profiling.component.html',
  styleUrls: ['./profiling.component.css']
})
export class ProfilingComponent implements OnInit {

  constructor(private reportService: ReportService, private toastService: ToastrService) { }
  users = [];


  ngOnInit(): void {
    this.reportService.getUsers().subscribe(
      (response) => {
        let x: any = response;
        this.users = x;
      },
      (error) => {
        this.toastService.error(
          'An error has occured please try again and report the issue if it persists.',
          'Error'
        );
      }
    );
  }

}
