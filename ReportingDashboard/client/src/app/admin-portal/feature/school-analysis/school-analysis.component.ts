import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../data-access/report.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import * as FileSaver from 'file-saver';

@Component({
  selector: 'app-school-analysis',
  templateUrl: './school-analysis.component.html',
  styleUrls: ['./school-analysis.component.css'],
})
export class SchoolAnalysisComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private reportService: ReportService,
    private toastService: ToastrService,
    private busyService: BusyService
  ) {}
  allGrades = [
    [
      {
        course: 'Computer Science with Finance',
        level: '',
        organization: 'MESD LMS Development Site',
        averageGrade: 20.765765765765767,
      },
      {
        course: 'Computer Science with Finance',
        level: 'Standard 1',
        organization: 'MESD LMS Development Site',
        averageGrade: 25.4,
      },
      {
        course: 'Algorithms',
        level: '',
        organization: 'MESD LMS Development Site',
        averageGrade: 14.882352941176471,
      },
      {
        course: 'Algorithms',
        level: 'Level 400',
        organization: 'MESD LMS Development Site',
        averageGrade: 13.4,
      },
      {
        course: 'Algorithms',
        level: 'Standard 1',
        organization: 'MESD LMS Development Site',
        averageGrade: 15.2,
      },
      {
        course: 'INTRODUCTION TO BIOLOGY',
        level: '',
        organization: 'MESD LMS Development Site',
        averageGrade: -4.5,
      },
      {
        course: 'INTRODUCTION TO BIOLOGY',
        level: 'Standard 1',
        organization: 'MESD LMS Development Site',
        averageGrade: -3.8,
      },
      {
        course: 'Computer Science with Finance',
        level: 'Level 400',
        organization: 'MESD LMS Development Site',
        averageGrade: 0,
      },
    ],
  ];

  grades = [];

  schools = [];
  subjects = [];

  reportForm: FormGroup;

  initializeForm() {
    this.reportForm = this.fb.group({
      school: ['', [Validators.required]],
    });
  }

  ngOnInit(): void {
    this.getReportStatusUpdate();

    this.initializeForm();
  }

  getReportStatusUpdate() {
    this.busyService.busy();

    this.reportService.getGrades().subscribe(
      (response) => {
        let x: any = response;
        this.allGrades = x;

        let count = 0;

        this.allGrades.forEach((school) => {
          if (
            !this.schools.includes({
              name: school[0].organization,
              index: count,
            })
          ) {
            this.schools.push({ name: school[0].organization, index: count });
          }
          count++;
        });

        this.busyService.idle();
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(
          'An error has occured please try again and report the issue if it persists',
          'Error'
        );
      }
    );
  }

  selectSchool() {
    this.grades = this.allGrades[this.reportForm.controls.school.value.index];

    this.grades.forEach((grade) => {
      if (!this.subjects.includes(grade.course)) {
        this.subjects.push(grade.course);
      }
    });
  }

  formatGrade(grade) {
    return grade.toFixed(2);
  }

  exportExcel() {
    import('xlsx').then((xlsx) => {
      const worksheet = xlsx.utils.json_to_sheet(this.grades);
      const workbook = { Sheets: { data: worksheet }, SheetNames: ['data'] };
      const excelBuffer: any = xlsx.write(workbook, {
        bookType: 'xlsx',
        type: 'array',
      });
      this.saveAsExcelFile(excelBuffer, 'products');
    });
  }
  saveAsExcelFile(buffer: any, fileName: string): void {
    let EXCEL_TYPE =
      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
    let EXCEL_EXTENSION = '.xlsx';
    const data: Blob = new Blob([buffer], {
      type: EXCEL_TYPE,
    });
    FileSaver.saveAs(
      data,
      fileName + '_export_' + new Date().getTime() + EXCEL_EXTENSION
    );
  }
}
