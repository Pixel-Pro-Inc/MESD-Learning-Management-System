import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SchoolAnalysisComponent } from './school-analysis.component';

describe('SchoolAnalysisComponent', () => {
  let component: SchoolAnalysisComponent;
  let fixture: ComponentFixture<SchoolAnalysisComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SchoolAnalysisComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SchoolAnalysisComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
