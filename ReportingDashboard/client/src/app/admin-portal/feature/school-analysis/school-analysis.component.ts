import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../data-access/report.service';


@Component({
  selector: 'app-school-analysis',
  templateUrl: './school-analysis.component.html',
  styleUrls: ['./school-analysis.component.css']
})
export class SchoolAnalysisComponent implements OnInit {

  graderesults: any[] = []; 
  courseKeys: string[] = []; // New property to hold the course keys
  schoolid= '';

  constructor(private reportService: ReportService) { 
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

  ngOnInit(): void { }

  findSchoolStatusUpdate(){
    //return this.graderesults.where( x=> x.schoolname==schoolid);
  }

}
