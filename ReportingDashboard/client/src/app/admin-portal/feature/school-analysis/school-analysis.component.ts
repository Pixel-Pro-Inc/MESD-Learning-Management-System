import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../data-access/report.service';
//import { ToastrService } from 'ngx-toastr/toastr/toastr.service';

@Component({
  selector: 'app-school-analysis',
  templateUrl: './school-analysis.component.html',
  styleUrls: ['./school-analysis.component.css']
})
export class SchoolAnalysisComponent implements OnInit {

  graderesults: any[] = []; 
  courseKeys: string[] = []; // New property to hold the course keys
  schoolid= '';

  constructor(private reportService: ReportService,
    // 
    ) { 
      this.getReportStatusUpdate();
  }

  ngOnInit(): void { }

  getReportStatusUpdate(){
    this.reportService.report_status_update().subscribe(
      (response)=>{
        let x:any = response;
          this.graderesults= x;
      },
      (error) =>{
        //this.toastService.error("An error has occured please try again and report the issue if it persists", 'Error')
      }
     );
      // After getting the graderesults, populate the courseKeys
    if (this.graderesults.length > 0) {
      this.courseKeys = Object.keys(this.graderesults[0]).filter(k => k !== 'level');
    }
  }
  findSchoolStatusUpdate(){
    console.log('It tried searching ${this.schoolid}');
    //return this.graderesults.where( x=> x.schoolname==schoolid);
  }
  onSubmit(): void {
      // Set the schoolid property with the input value
      this.schoolid = this.schoolid;
      // Call the findSchoolStatusUpdate method
      this.findSchoolStatusUpdate();
  }  

}
