import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DclReviewComponent } from './dcl-review.component';

describe('DclReviewComponent', () => {
  let component: DclReviewComponent;
  let fixture: ComponentFixture<DclReviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DclReviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DclReviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
