import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../data-access/report.service';
import { TableModule } from 'primeng/table';


@Component({
  selector: 'app-school-analysis',
  templateUrl: './school-analysis.component.html',
  styleUrls: ['./school-analysis.component.css']
})
export class SchoolAnalysisComponent implements OnInit {

  graderesults= [];

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
  }

  ngOnInit(): void { }

}
