import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { FileUpload } from 'primeng/fileupload';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-4',
  templateUrl: './psdl-information-4.component.html',
  styleUrls: ['./psdl-information-4.component.css'],
})
export class PsdlInformation4Component implements OnInit {
  @ViewChild('fileUpload') fileUpload: FileUpload;
  constructor(
    private fb: FormBuilder,
    private toastService: ToastrService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;
  uploadedFiles: any[] = [];

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      files: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence != null) {
      if (prefs.permitFormsPersistence.psdl4 != null) {
        this.serviceForm.setValue(prefs.permitFormsPersistence.psdl4);
      }
    }
  }

  files = [];

  onFileSelect(event: any) {
    const selectedFiles = this.fileUpload.files;

    this.files = [];

    if (selectedFiles && selectedFiles.length > 0) {
      for (let i = 0; i < selectedFiles.length; i++) {
        const file = selectedFiles[i];

        const reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = () => {
          this.files.push({
            fileName: file.name,
            fileUrl: reader.result as string,
          });

          this.serviceForm.controls.files.setValue(this.files);
        };
      }
    }
  }

  next() {
    //Store form data
    const selectedFiles = this.fileUpload.files;

    this.files = [];

    if (selectedFiles && selectedFiles.length > 0) {
      for (let i = 0; i < selectedFiles.length; i++) {
        const file = selectedFiles[i];

        const reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = () => {
          this.files.push({
            fileName: file.name,
            fileUrl: reader.result as string,
          });

          this.serviceForm.controls.files.setValue(this.files);
        };
      }
    }

    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence == null) {
      prefs.permitFormsPersistence = {};
    }

    prefs.permitFormsPersistence.psdl4 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl('/portal/permits/rdep-confirmation');
  }

  previous() {
    this.routerService.navigateByUrl('/portal/permits/rdep-information-3');
  }
}
