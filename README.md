```mermaid
graph TD
    %% Define Styles
    classDef llm fill:#f9f,stroke:#333,stroke-width:2px,color:black;
    classDef memory fill:#ff9,stroke:#333,stroke-width:2px,color:black;
    classDef tools fill:#9cf,stroke:#333,stroke-width:2px,color:black;
    classDef control fill:#f96,stroke:#333,stroke-width:4px,color:black;

    %% --- 1. THE CONTROL PLANE ---
    subgraph "Control Plane (Deterministic)"
        Scheduler((🕒 Scheduler))
        Orchestrator[<b>Orchestrator</b><br>State Machine Logic]:::control
    end

    %% --- 2. THE COGNITIVE LAYER ---
    subgraph "Cognitive Layer (Probabilistic)"
        LLM[<b>LLM API</b><br>Decision & Drafting]:::llm
    end

    %% --- 3. DATA PLANE ---
    subgraph "Data Plane"
        StateDB[(<b>State DB</b><br>Task Status, Logs)]:::memory
        AuditLog[<b>Audit Trail</b><br>Compliance Records]:::memory
    end

    %% --- 4. TOOL LAYER ---
    subgraph "Tool Interfaces"
        DriveTool[<b>Google Drive</b><br>File Inspection]:::tools
        CommsTool[<b>Gmail API</b><br>Communication]:::tools
        CalTool[<b>Calendar API</b><br>Scheduling]:::tools
    end

    %% --- FLOW ---
    Scheduler --> Orchestrator
    Orchestrator -->|1. Query State| StateDB
    Orchestrator -->|2. Observe Env| DriveTool
    DriveTool -.->|File Metadata| Orchestrator
    Orchestrator -->|3. Request Plan| LLM
    LLM -.->|4. Return Plan| Orchestrator
    Orchestrator -->|5. Execute Tool| CommsTool
    Orchestrator -->|5. Execute Tool| CalTool
    Orchestrator -->|6. Update State| StateDB
    Orchestrator -->|7. Log Event| AuditLog
