import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlReviewComponent } from './psdl-review.component';

describe('PsdlReviewComponent', () => {
  let component: PsdlReviewComponent;
  let fixture: ComponentFixture<PsdlReviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PsdlReviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PsdlReviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
